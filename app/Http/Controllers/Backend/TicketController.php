<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\tickets\CrudTicketRequest;
use App\Models\File;
use App\Models\LTicket;
use App\Models\Priorite;
use App\Models\Service;
use App\Models\Ticket;
use App\Traits\sendMails;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    use UploadFiles, sendMails;

    public function __construct()
    {
        $this->middleware('permission:liste_tickets', ['only' => 'index']);
        $this->middleware('permission:ajouter_ticket', ['only' => ['create', "store"]]);
        $this->middleware('permission:repondre_ticket', ['only' => ['show', 'replied_ticket']]);
        $this->middleware('permission:fermé_ticket', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $title = "tickets";
        $tickets = [];

        if ($user->roles_name[0] == "client" and $user->IDClient != null) {
            $tickets = Ticket::where("IDClient", $user->IDClient)->get();
        } else {
            $tickets = Ticket::with(['client', 'service'])->get();
        }

        return view('backend.views.tickets.index', compact("title", "tickets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "nouvelle ticket";
        $authUser = auth()->user();
        $services = Service::pluck('libelle', "id")->toArray();
        $priorities = Priorite::pluck('libelle', "id")->toArray();

        return view("backend.views.tickets.create", compact('title', "authUser", "services", "priorities"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudTicketRequest $request)
    {

        // add ticket
        $data = Arr::except($request->all(), ["files", "message"]);
        $data["IDClient"] = auth()->user()->IDClient;
        $newTicket = new Ticket();
        $newTicket = $newTicket->create($data);

        // add replied
        $replied['description'] = $request->message;
        $replied['IDTicket'] = $newTicket->id;
        $replied['IDUtilisateur'] = Auth::id();
        $replied['IDClient'] = Auth::user()->IDClient;

        $newReply = new LTicket();
        $newReply->fill($replied)->save();

        // store files for this reply
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $reply_id = $newReply->id;
            $ticket_id = $newTicket->id;

            File::add_ReplyFiles($files, $reply_id, $ticket_id);
        }

        // send mail to department server selected
        sendMails::newMail($newTicket);

        return redirect_with_flash("msgSuccess", "ticket created successsfully", "tickets");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if (Auth::user()->roles_name[0] != "client" and $ticket->statut != "ferme") {
            $ticket->fill(['statut' => "en cours"])->save();
        }

        $title = "ticket - " . $ticket->id . " ( " . date_format($ticket->created_at, "Y-m-d") . " )";
        $services = Service::pluck('libelle', "id")->toArray();
        $priorities = Priorite::pluck('libelle', "id")->toArray();
        $replies = LTicket::where('IDTicket', $ticket->id)->with(['client.user', "admin", "files"])->latest()->get();

        return view('backend.views.tickets.replied', compact("title", "ticket", 'services', 'priorities', "replies"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    // add new reply for spesific ticket
    public function replied_ticket(Request $request)
    {
        $ticket_id = $request->IDTicket;
        $ticket = Ticket::find($ticket_id);
        if ($ticket == null) {
            return redirect_to_404_if_emty($ticket);
        }

        $this->validate($request, ['description' => 'required|string']);

        // store reply
        $replyData['description'] = $request->description;
        $replyData['IDTicket'] = $ticket->id;
        $replyData['IDUtilisateur'] = Auth::id();
        $replyData['IDClient'] = Auth::user()->roles_name[0] == "client" ? Auth::id() : null;

        $newReply = new LTicket();
        $newReply->fill($replyData)->save();

        // store files for this reply
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $reply_id = $newReply->id;
            $ticket_id = $ticket->id;

            File::add_ReplyFiles($files, $reply_id, $ticket_id);
        }

        // change ticket status its closed
        if ($ticket->statut == "ferme") {
            $ticket->fill(['statut' => "en cours"])->save();
        }


        // send mail to department server selected
        sendMails::newMail($ticket, $ticket->lastReply()['from']);

        return redirect_with_flash("msgSuccess", 'votre msg est envoyé avec succès', 'tickets/' . $ticket->id);
    }

    // close ticket
    public function closeTicket(Request $request)
    {
        $ticket = Ticket::find($request->ticket);
        if ($ticket == null) {
            return redirect_to_404_if_emty($ticket);
        }

        $ticket->fill(["statut" => "ferme"])->save();

        return redirect_with_flash("msgSuccess", "ticket fermer avec succès", "tickets");
    }
}

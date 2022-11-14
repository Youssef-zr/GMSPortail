<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\employes\CrudEmployeRequest;
use App\Models\Client;
use App\Models\Employe;
use App\Models\Site;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:liste_clients', ['only' => 'index']);
        $this->middleware('permission:ajouter_employé', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_employé', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_employé', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "employés";
        $employes = Employe::orderBy('IDCLient', "asc")->get();
        $clients = Client::whereHas('employes')->pluck('raison_sociale', "id")->toArray();

        return view("backend.views.employes.index", compact("title", "employes", "clients"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nouveau employé";
        $clients = Client::pluck('raison_sociale', "id")->toArray();
        $sites = Site::pluck('libelle', "id")->toArray();

        return view("backend.views.employes.create", compact("title", "clients", "sites"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudEmployeRequest $request)
    {
        $data = $request->all();
        $new = new Employe();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "employé ajouté avec succès", "employes");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        $title = "Éditer employé";
        $clients = Client::pluck('raison_sociale', "id")->toArray();
        $sites = Site::pluck('libelle', "id")->toArray();

        return view("backend.views.employes.update", compact('title', "employe", "sites", "clients"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(CrudEmployeRequest $request, Employe $employe)
    {
        $data = $request->all();
        $employe->fill($data)->save();

        return redirect_with_flash("msgsuccess", "employé ajouté avec succès", "employes");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();

        return redirect_with_flash("msgSuccess", "employé a été supprimé avec succès", "employes");
    }

    // search client employes
    public function clientEmployeSearch(Request $request)
    {
        $client_id = $request->client;
        $client = Client::whereId($client_id)->first();
        if ($client == null) {
            return redirect_to_404_if_emty($client);
        }

        $title = "employés - " . $client->raison_sociale;
        $employes = Employe::where('IDCLient', $client_id)->with('client')->get();
        $clients = Client::whereHas('employes')->pluck('raison_sociale', "id")->toArray();

        return view('backend.views.employes.index', compact('title', "employes", "clients"));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\events\CrudEventRequest;
use App\Models\Client;
use App\Models\Planning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PlanningController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:liste_événements', ['only' => 'index']);
        $this->middleware('permission:ajouter_événement', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_événement', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_événement', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "plannings";

        $clients = Client::whereHas("events")->pluck('raison_sociale', "id")->toArray();
        $clients[0] = 'tout';
        $clients = collect($clients)->reverse()->toArray();

        $authUserRole = auth()->user()->roles->first()->name;
        $IDClient = auth()->user()->IDClient;

        if ($authUserRole == "client") {
            $events = Planning::where('IDClient', $IDClient)->with("client")->get();
        } else {
            $events = Planning::with("client")->get();
        }

        return view('backend.views.plannings.index', compact("title", "events", "clients"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Plannings";
        $clients = Client::pluck('raison_sociale', "id")->toArray();

        return view("backend.views.plannings.create", compact("title", "clients"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudEventRequest $request)
    {
        $new = new Planning();
        $new->fill($request->all())->save();

        return redirect_with_flash('msgSuccess', "événement créé avec succès", "plannings");
    }

    // display view to show one event
    public function show($id_event)
    {
        $title = "evenement";
        $events = Planning::where("id", $id_event)->get();
        $jsonItems = $this->events($events);

        return view("backend.views.plannings.show-calendar", compact('title', "id_event"));
    }
    // dislay one event as json
    public function showJson($id_event)
    {
        $events = Planning::where("id", $id_event)->get();
        $jsonItems = $this->events($events);

        return $jsonItems;
    }

    // show clients events
    public function clients_planning(Request $request)
    {
        $events = Planning::with('client');

        if ($request->client != 0) {
            $events = $events->where('IDCLient', $request->client);
        }
        $events = $events->get();

        if ($events == null) {
            return redirect_to_404_if_emty($events);
        }

        $title = "plannings";
        $clients = Client::whereHas("events")->pluck('raison_sociale', "id")->toArray();
        $clients[0] = 'tout';
        $clients = collect($clients)->reverse()->toArray();

        return view('backend.views.plannings.index', compact("title", "events", "clients"));
    }

    // show the view of client full events
    public function clientFullEventsView($id_client)
    {
        $title = "tout les evenments des clients";

        try {
            $id_client = decrypt($id_client);
            
        } catch (DecryptException $e) {
            $id_client = intval($id_client);
        }
        
        if ($id_client != 0) {
            $client = Client::findOrFail($id_client);
            $title = $client->raison_sociale . " - evenements";
        }

        return view("backend.views.plannings.client-fullCalendar-events", compact('title', "id_client"));
    }

    // show the response json for full events of client
    public function clientFullEventsJson($id_client)
    {
        if ($id_client == 0) {
            $events = Planning::with('client')->get();
        } else {
            $events = Planning::where("IDCLient", $id_client)->get();
        }

        $jsonItems = $this->events($events);

        return $jsonItems;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function edit(Planning $planning)
    {
        $title = "editer evenement";
        $clients = Client::pluck('raison_sociale', "id")->toArray();

        return view("backend.views.plannings.update", compact("title", "clients", "planning"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function update(CrudEventRequest $request, Planning $planning)
    {
        $planning->fill($request->all())->save();

        return redirect_with_flash("msgSuccess", "événement mis à jour avec succès", "plannings");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planning $planning)
    {
        $planning->delete();

        return redirect_with_flash("msgSuccess", "l'événement a été supprimé avec succès", "plannings");
    }

    // --- spesific methods
    /**
     * @param $facility
     * @param $asset
     * @return string
     */
    public function events($events)
    {
        $items = array();

        foreach ($events as $event) {

            if ($event->repeats == 1 and $event->periodicity == "personalized") {

                //create multiple entries for repeating events
                //count days from start to end and repeat
                if ($event->freq_term == 'day') {
                    foreach ($this->getDailyTasks($event) as $s) {
                        array_push($items, $s);
                    }
                }

                if ($event->freq_term == 'week') {
                    foreach ($this->getWeeklyTasks($event) as $s) {
                        array_push($items, $s);
                    }
                }

                if ($event->periodicity == "every_month" || $event->periodicity == "every_3_month") {
                    $nbMonths = $event->periodicity == "every_month" ? 1 : 3;
                    foreach ($this->getMonthlyTasks($event, $nbMonths) as $s) {
                        array_push($items, $s);
                    }
                }
            } else {

                if ($event->periodicity == "once" || $event->periodicity == "every_day" || $event->periodicity == "every_monday") {
                    foreach ($this->getDayTask($event) as $s) {
                        array_push($items, $s);
                    }
                } else if ($event->periodicity == "every_month" || $event->periodicity == "every_3_month") {
                    $nbMonths = $event->periodicity == "every_month" ? 1 : 3;
                    foreach ($this->getMonthlyTasks($event, $nbMonths) as $s) {
                        array_push($items, $s);
                    }
                }
            }
        }

        return json_encode($items);
    }

    /**
     * @param $event
     * @param $start
     * @param $end
     * @return array
     */
    public function getEvent($event, $start, $end)
    {
        $repeat = $event->periodicity;
        $repetition = [];

        if (in_array($repeat, ['every_day', "every_monday"])) {
            $repetition['startRecur'] = $event->start_date;
            $repetition['endRecur'] = $event->end_date;

            if ($repeat == "every_day") {
            } elseif ($repeat == "every_monday") {
                $repetition['daysOfWeek'] = [1];
            }
        }

        $array = array(
            'id' => (int) $event->id,
            'title' => $event->title . " - " . $event->client->raison_sociale,
            'start' => $start->format('Y-m-d H:i:s'),
            'end' => $end->format('Y-m-d H:i:s'),
            "allDay" => true,
            'description' => $event->notes,
            "color" => $event->color,
        );

        $array = array_merge($array, $repetition);

        return $array;
    }
    /**
     * single day task
     * @param $event
     * @return array
     */
    public function getDayTask($event)
    {
        $start = Carbon::parse($event->start_date);
        if ($event->end_date == "") {
            $end = Carbon::parse($start)->addDays(1);
        } else {
            $end = Carbon::parse($event->end_date);
        }

        $events[] = $this->getEvent($event, $start, $end);

        return $events;
    }

    /**
     * repeating tasks even (n) days. Note if you can even put 7 days to make them weekly.
     *
     * @param $event
     * @return array
     */
    public function getDailyTasks($event)
    {
        $start = Carbon::parse($event->start_date);
        $end = Carbon::parse($event->end_date);
        $events = array();

        if ($event->end_date == "") {
            $days = $event->freq ?? 1;
            $date = $start;

            for ($i = 1; $i <= $days; $i++) {
                $start = $date;
                $events[] = $this->getEvent($event, $start, $date);
                $date = Carbon::parse($date)->addDays(1);
            }
        } else {
            $days = $end->diffInDays($start);
            $freq = $event->freq;
            $days = $days >= $freq ? $freq ?? $days : $days;

            for ($i = 1; $i <= $days; $i++) {
                $end = Carbon::parse($start)->addDays(1);
                $events[] = $this->getEvent($event, $start, $end);
                $start = Carbon::parse($start)->addDays(1);
            }
        }

        return $events;
    }

    /**
     * Weekly events repeating every (n) weeks
     * @param $event
     * @return array
     */
    public function getWeeklyTasks($event)
    {
        $end = Carbon::parse($event->end_date);
        $start = Carbon::parse($event->start_date);
        $weeks = $end->diffInWeeks($start);

        $events = array();
        $date = $start;

        for ($i = 1; $i <= $weeks + 1; $i++) {
            $events[] = $this->getEvent($event, $date, $date);
            $date = Carbon::parse($date)->addWeeks($event->freq);
        }

        return $events;
    }

    /**
     * Monthly events repeating every (n) months
     * @param $event
     * @return array
     */
    public function getMonthlyTasks($event, $nbMonths)
    {
        $start = Carbon::parse($event->start_date);
        $end = Carbon::parse($event->end_date);

        if ($event->end_date == "") {
            $months = $event->freq ?? 12;
            $date = $start;

            for ($i = 1; $i <= $months; $i++) {
                $start = $date;
                $events[] = $this->getEvent($event, $date, $date);
                $date = Carbon::parse($date)->addMonths($nbMonths);
            }
        } else {

            $months = $end->diffInMonths($start);
            $freq = $event->freq;
            $months = ($months >= $freq and $freq != null) ? $freq ?? $nbMonths : $months;

            for ($i = 1; $i <= $months; $i++) {
                $events[] = $this->getEvent($event, $start, $start);
                $start = Carbon::parse($start)->addMonths($nbMonths);
            }
        }
        return $events;
    }
}

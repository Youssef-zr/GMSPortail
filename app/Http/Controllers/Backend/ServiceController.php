<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\services\CrudServiceRequest;
use App\Http\Requests\sites\CrudSiteRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:liste_services', ['only' => 'index']);
        $this->middleware('permission:ajouter_service', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_service', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_service', ['only' => 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Ajoute nouveau service";

        return view("backend.views.services.create", compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudServiceRequest $request)
    {
        $data = $request->all();
        $new = new Service();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "service ajouté avec succès", "settings");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $title = "éditer service";

        return view('backend.views.services.update', compact("service", 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(CrudSiteRequest $request, Service $service)
    {
        $data = $request->all();
        $service->fill($data)->save();

        return redirect_with_flash("msgSuccess", "service mis à jour avec succès", "settings");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect_with_flash("msgSuccess", "service supprimé avec succès", "settings");
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\priorities\CrudPrioriteRequest;
use App\Models\Priorite;
use Illuminate\Http\Request;

class PrioriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:liste_priorités', ['only' => 'index']);
        $this->middleware('permission:ajouter_priorité', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_priorité', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_priorité', ['only' => 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Ajoute nouveau priorité";

        return view("backend.views.priorities.create", compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudPrioriteRequest $request)
    {
        $data = $request->all();
        $new = new Priorite();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "Priorité ajouté avec succès", "settings");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Priorite  $priorite
     * @return \Illuminate\Http\Response
     */
    public function show(Priorite $priorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Priorite  $priorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Priorite $priorite)
    {
        $title = "éditer priorité";

        return view("backend.views.priorities.update", compact("title", "priorite"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Priorite  $priorite
     * @return \Illuminate\Http\Response
     */
    public function update(CrudPrioriteRequest $request, Priorite $priorite)
    {
        $data = $request->all();
        $priorite->fill($data)->save();

        return redirect_with_flash("msgSuccess", "Priorité Mis à jour avec succés", "settings");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Priorite  $priorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Priorite $priorite)
    {
        $priorite->delete();

        return redirect_with_flash("msgSuccess", "Priorité supprimé avec succès", "settings");
    }
}

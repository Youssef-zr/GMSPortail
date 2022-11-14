<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\sites\CrudSiteRequest;
use App\Models\Client;
use App\Models\Site;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:liste_sites', ['only' => 'index']);
        $this->middleware('permission:ajouter_site', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_site', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_site', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "sites list";
        $authUser = auth()->user();

        if ($authUser->roles[0]->name != "client") {
            $sites = Site::with("client")->orderBy("id", "desc")->get();
        } else {
            $sites = Site::with("client")->where("IDClient", $authUser->IDClient)->orderBy("id", "desc")->get();
        }

        return view("backend.views.sites.index", compact("title", "sites"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "nouveau site";
        $clients = Client::pluck('raison_sociale', "id")->toArray();

        return view('backend.views.sites.create', compact("title", "clients"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudSiteRequest $request)
    {
        $data = $request->all();
        $new = new Site();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "site ajouté avec succès", "sites");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        $title = "Editer site - " . $site->libelle;
        $clients = Client::pluck('raison_sociale', "id")->toArray();

        return view("backend.views.sites.update", compact("title", "site","clients"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(CrudSiteRequest $request, Site $site)
    {
        $data = $request->all();
        $site->fill($data)->save();

        return redirect_with_flash("msgSuccess", "site editer avec succès", "sites");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();

        return redirect_with_flash("msgSuccess", "site supprimé avec succès", "sites");
    }
}

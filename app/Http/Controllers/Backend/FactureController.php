<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\invoices\CrudInvoiceRequest;
use App\Models\Client;
use App\Models\Facture;
use App\Traits\UploadFiles;

class FactureController extends Controller
{
    use UploadFiles;

    public function __construct()
    {
        $this->middleware('permission:liste_facture', ['only' => 'index']);
        $this->middleware('permission:ajouter_facture', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_facture', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_facture', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "factures";
        $authUser = auth()->user()->roles->first()->name;
        $IDClient = auth()->user()->IDClient;

        if ($authUser == "client") {
            $invoices = Facture::where('IDClient', $IDClient)->get();
        } else {
            $invoices = Facture::with('client')->get();
        }

        return view("backend.views.factures.index", compact("invoices", "title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nouveau facture";
        $clients = Client::pluck('raison_sociale', "id")->toArray();

        return view("backend.views.factures.create", compact("title", 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudInvoiceRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('nom_fichier')) {

            $file = $request->file('nom_fichier');
            $storagePath = "assets/dist/storage/invoiceFiles";
            $fileInformation = UploadFiles::storeFile($file, $storagePath);

            $data['nom_fichier'] = $fileInformation['file_name'];
            $data['chemin'] = $fileInformation['file_path'];
        }

        $new = new Facture();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "facture ajoutée avec succès", "invoices");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice_id)
    {
        $title = "editer facture";
        $invoice = Facture::findOrFail($invoice_id);
        $clients = Client::pluck('raison_sociale', "id")->toArray();

        return view("backend.views.factures.update", compact("title", "invoice", "clients"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(CrudInvoiceRequest $request, $invoice_id)
    {
        $data = $request->all();
        $invoice = Facture::findOrfail($invoice_id);

        if ($request->hasFile('nom_fichier')) {

            $file = $request->file('nom_fichier');
            $storagePath = "assets/dist/storage/invoiceFiles";
            $fileInformation = UploadFiles::updateFile($file, $storagePath, $invoice->chemin);

            $data['nom_fichier'] = $fileInformation['file_name'];
            $data['chemin'] = $fileInformation['file_path'];
        }

        $invoice->fill($data)->save();

        return redirect_with_flash("msgSuccess", "facture modifier avec succès", "invoices");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice_id)
    {
        $invoice = Facture::findOrFail($invoice_id);
        UploadFiles::removeFile($invoice->chemin);
        $invoice->delete();

        return redirect_with_flash("msgSuccess", "facture supprimer avec succès", "invoices");
    }
}

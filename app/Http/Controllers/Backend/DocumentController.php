<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\documents\CrudDocumentsRequest;
use App\Models\Client;
use App\Models\Document;
use App\Models\TypeDocument;
use App\Traits\UploadFiles;

class DocumentController extends Controller
{
    use UploadFiles;

    public function __construct()
    {
        $this->middleware('permission:liste_documents', ['only' => 'index']);
        $this->middleware('permission:ajouter_document', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_document', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_document', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "documents";
        $typeDocuments = TypeDocument::pluck('libelle', "id")->toArray();
        $typeDocuments[0] = 'tout';
        $typeDocuments = collect($typeDocuments)->reverse()->toArray();
        
        $authUser = auth()->user()->roles->first()->name;
        $IDClient = auth()->user()->IDClient;

        if ($authUser == "client") {
            $documents = Document::where('IDClient', $IDClient)->with("client", "typeDocument")->get();
        } else {
            $documents = Document::with("client", "typeDocument")->get();
        }

        return view('backend.views.documents.index', compact("documents", "title","typeDocuments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nouveau document";
        $clients = Client::pluck('raison_sociale', "id")->toArray();
        $typesDocument = TypeDocument::pluck('libelle', "id")->toArray();

        return view("backend.views.documents.create", compact("title", "clients", "typesDocument"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudDocumentsRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('nom_fichier')) {
            $file = $request->file('nom_fichier');
            $storagePath = "assets/dist/storage/documents";
            $fileInformation = UploadFiles::storeFile($file, $storagePath);

            $data['nom_fichier'] = $fileInformation['file_name'];
            $data['chemin'] = $fileInformation['file_path'];
        }

        $new = new Document();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "document ajouté avec succès", "documents");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(document $document)
    {
        $title = "editer document";
        $clients = Client::pluck('raison_sociale', "id")->toArray();
        $typesDocument = TypeDocument::pluck('libelle', "id")->toArray();

        return view("backend.views.documents.update", compact('title', "document", "clients", "typesDocument"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(CrudDocumentsRequest $request, document $document)
    {
        $data = $request->all();
        if ($request->hasFile('nom_fichier')) {
            $file = $request->file('nom_fichier');
            $storagePath = "assets/dist/storage/documents";

            $fileData = UploadFiles::updateFile($file, $storagePath, $document->chemin);
            $data['nom_fichier'] = $fileData['originalName'];
            $data['chemin'] = $fileData['path'];
        }
        $document->fill($data)->save();

        return redirect_with_flash("msgSuccess", "document editer avec succès", "documents");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(document $document)
    {
        $filePath = $document->chemin;
        UploadFiles::removeFile($filePath);
        $document->delete();

        return redirect_with_flash("msgSuccess", "document supprimer avec succès", "documents");
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\typeDocuments\CrudTypeDocuments;
use App\Models\Document;
use App\Models\TypeDocument;

class TypeDocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:liste_type_documents', ['only' => 'index']);
        $this->middleware('permission:ajouter_type_document', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_type_document', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_type_document', ['only' => 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nouveau type";

        return view("backend.views.typeDocuments.create", compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudTypeDocuments $request)
    {
        $data = $request->all();
        $new = new TypeDocument();
        $new->fill($data)->save();

        return redirect_with_flash('msgSucess', "type de document ajouté avec succès", "settings");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDocument $typeDocument)
    {
        $title = "éditer type";

        return view("backend.views.typeDocuments.update", compact("title", "typeDocument"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function update(CrudTypeDocuments $request, TypeDocument $typeDocument)
    {
        $data = $request->all();
        $typeDocument->fill($data)->save();

        return redirect_with_flash('msgSuccess', "type de document mis à jour avec succès", "settings");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDocument $typeDocument)
    {
        $typeDocument->delete();

        return redirect_with_flash('msgSuccess', "type document supprimé avec succès", "settings");
    }

    public function search()
    {
        $id_type = request()->type;
        $typeDocument = TypeDocument::find($id_type);

        $title = "documents";
        $typeDocuments = TypeDocument::pluck('libelle', "id")->toArray();
        $typeDocuments[0] = 'tout';
        $typeDocuments = collect($typeDocuments)->reverse()->toArray();

        $authUser = auth()->user()->roles->first()->name;
        $IDClient = auth()->user()->IDClient;

        $documents = [];
        $query = Document::with("client", "typeDocument");

        if ($id_type != 0) {
            $query = $query->where("IDType", $id_type);
        }

        if ($authUser == "client") {
            $documents = $query->where('IDClient', $IDClient)->get();
        } else {
            $documents = $query->get();
        }

        return view('backend.views.documents.index', compact("documents", "title", "typeDocuments"));
    }
}

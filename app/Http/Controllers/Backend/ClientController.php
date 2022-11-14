<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Http\Requests\clients\CrudClientRequest;
use App\Http\Requests\clients\users\CrudClientUsersRequest;
use App\Models\Client;
use App\Models\Employe;
use App\Traits\UploadFiles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    use UploadFiles;

    public function __construct()
    {
        $this->middleware('permission:liste_clients', ['only' => 'index']);
        $this->middleware('permission:ajouter_client', ['only' => ['create', "store"]]);
        $this->middleware('permission:editer_client', ['only' => ['edit', "update"]]);
        $this->middleware('permission:supprimer_client', ['only' => 'destroy']);
        $this->middleware('permission:afficher_client_utilisateurs', ['only' => 'clientUsers']);
        $this->middleware('permission:noveau_utilisateur_client', ['only' => ['newUserCreate', "ClientNewUserCreate", "newUserStore"]]);
        $this->middleware('permission:editer_utilisateur_client', ['only' => ['userEdit', "userUpdate"]]);
        $this->middleware('permission:supprimer_utilisateur_client', ['only' => ['userdelete', "userdelete"]]);
        $this->middleware('permission:afficher_client_employes', ['only' => 'clientEmployesList']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "list des clients";
        $clients = Client::withCount(['users', "employes"])->orderBy("id", "desc")->get();

        return view("backend.views.clients.index", compact('clients', "title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Ajouter Nouveau Client";

        return view("backend.views.clients.create", compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudClientRequest $request)
    {
        $data = Arr::except($request->all(), ["photo"]);
        $data['sync'] = on_off()[$request->sync];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $storagePath = "assets/dist/storage/clients";
            $fileInformation = UploadFiles::storeFile($file, $storagePath);

            $data['nom_fichier'] = $fileInformation['file_name'];
            $data['chemin'] = $fileInformation['file_path'];
        }

        $new = new Client();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", "client ajouté avec succès", "clients");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $title = "Editer Client";

        return view("backend.views.clients.update", compact('title', "client"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(CrudClientRequest $request, Client $client)
    {

        $data = Arr::except($request->all(), ['_token', 'photo']);
        $data['sync'] = on_off()[$request->sync];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $storagePath = "assets/dist/storage/clients";
            $fileInformation = UploadFiles::updateFile($file, $storagePath, $client->chemin, $client->nom_fichier);

            $data['nom_fichier'] = $fileInformation['file_name'];
            $data['chemin'] = $fileInformation['file_path'];
        }
        $client->fill($data)->save();

        return redirect_with_flash("msgSuccess", "client addedd successfully", "clients");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $filePath = $client->chemin;
        UploadFiles::removeFile($filePath, $client->nom_fichier);
        $client->delete();

        return redirect_with_flash('msgSuccess', "client supprimé avec succès", "clients");
    }

    //-------------------------------
    // client users crud
    //-------------------------------

    // show client users list
    public function clientUsers($id_client)
    {
        $clientUsers = Client::with('users')->whereId($id_client)->first();
        if ($clientUsers == null) {
            return redirect_to_404_if_emty($clientUsers);
        }
        $title = $clientUsers->raison_sociale . " - Utilisateurs";

        return view("backend.views.clients.users.index", compact('title', "clientUsers"));
    }

    // show form create new user
    public function newUserCreate()
    {
        $title = "nouveau utilisateur";
        $clients = Client::all();
        $clients = Client::pluck("raison_sociale", 'id')->toArray();

        return view("backend.views.clients.users.create", compact("title", "clients"));
    }

    // show create form for specific client to create new user
    public function ClientNewUserCreate($client_id)
    {
        $title = "nouveau utilisateur";
        $client = Client::findOrFail($client_id);
        $clients = [$client->id => $client->raison_sociale];

        return view("backend.views.clients.users.create", compact("title", "clients"));
    }

    // store user information
    public function newUserStore(CrudClientUsersRequest $request)
    {
        $data = Arr::except($request->all(), ['_token']);
        $data['password'] = Hash::make($data['password']);
        $user = new User();
        $user->fill($data)->save();

        $user->assignRole('client');

        return redirect_with_flash('msgSuccess', "user addedd successfully", "clients");
    }

    // show form edit user information
    public function userEdit($client_id, $user_id)
    {
        $user = User::with("client")->find($user_id)->where('IDClient', $client_id)->first();
        $user->setAttribute('IDClient', $user->client->id);
        $clients = Client::pluck('raison_sociale', "id")->toArray();
        $title = $user->client->raison_sociale . " - " . $user->name;

        return view('backend.views.clients.users.update', compact('title', "user", "clients"));
    }

    // update existing user information
    public function userUpdate(CrudClientUsersRequest $request, $user)
    {
        $user = User::findOrFail($user);
        $data = $request->all();
        $data['password'] = $request->password ? bcrypt($request->password) : $user->password;
        $user->fill($data)->save();

        return redirect_with_flash("msgSuccess", "utilisateur mis à jour avec succès", "clients");
    }

    // delete client user
    public function userdelete($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect_with_flash("msgSuccess", 'utilisateur supprimé avec succès', "clients");
    }

    //-------------------------------
    // client employess
    //-------------------------------

    // show client employees list
    public function clientEmployesList($idClient)
    {
        $client = Client::find($idClient);
        $title = "employés - " . $client->raison_sociale;
        $clients = Client::pluck('raison_sociale', "id")->toArray();
        $employes = Employe::with("client")->orderBy('IDCLient', "asc")
            ->where('IDClient', $idClient)
            ->get();

        return view("backend.views.employes.index", compact("title", "employes", "clients"));
    }

    // ---------------
    // sync with omag
    // ---------------

    public function addClientsToQueue(Request $request)
    {
        $clients_ids = $request->input('sync');

        foreach ($clients_ids as $client_id) {
            $client = Client::where('code_client_omag', $client_id)->first();
            if ($client->sync == 1) {
                continue;
            }

            $client->fill(['sync' => "1"])->save();
        }

        return redirect_with_flash("msgSuccess", "synchronisation ok", "clients");
    }
}

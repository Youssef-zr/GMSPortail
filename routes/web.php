<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Auth routes list
Auth::routes(
    [
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]
);
Route::post('/login', ['uses' => 'Auth\LoginController@login', 'middleware' => 'CheckUserStatus']);

// site Routes frontEnd
Route::group(["middleware" => ['web'], 'namespace' => 'frontEnd'], function () {
    Route::get('/', 'FrontController@home');
    Route::get('/contact', 'FrontController@contact');
    Route::post('/contact', 'FrontController@sendMail')->name('frontend.sendMail');
});

// Dashboard Routes BackEnd
Route::group(['prefix' => "dashboard", "middleware" => ['auth'], 'namespace' => 'Backend'], function () {

    // dashboard routes
    Route::get('/', 'DashboardController@welcome');
    Route::get('/settings', "DashboardController@settings");
    route::get('/logout', "DashboardController@logout");

    // clients routes
    Route::resource("clients", "ClientController");

    // --- clients users routes
    Route::get('/clients/{client_id}/users', "ClientController@clientUsers")->name('clients.users.list');
    Route::get('/clients/users/create', "ClientController@newUserCreate")->name('clients.users.create');
    Route::get('/clients/{client_id}/users/create', "ClientController@ClientNewUserCreate")->name('clients.sp.users.create'); // create new user from client view
    Route::post('/clients/users/create', "ClientController@newUserStore")->name('clients.users.store');
    Route::get('/clients/{client_id}/users/{user_id}/edit', "ClientController@userEdit")->name('clients.user.edit');
    Route::patch('/clients/users/{user}', "ClientController@userUpdate")->name('clients.user.update');
    Route::delete('/clients/user/{user_id}', "ClientController@userdelete");

    // client sync and queue
    Route::post('/clients/add_to_queue', "ClientController@addClientsToQueue")->name('client.sync_client_queue'); // add list of clients to queue -> change sync status in db clients

    // --- clients employes routes
    Route::get('/clients/employes/list/{client_id}', "ClientController@clientEmployesList")->name('clients.employes.list');

    // sites routes
    Route::resource("/sites", "SiteController");

    // employees routes
    Route::resource("/employes", "EmployeController");
    Route::get('/employes/client/search', 'EmployeController@clientEmployeSearch')->name('employes.client.search');

    // documents routes
    Route::resource("/documents", "DocumentController");

    // invoices routes
    Route::resource("/invoices", "FactureController");

    // services routes
    Route::resource("/services", "ServiceController")->except(['index']);

    // priorites routes
    Route::resource("/priorites", "PrioriteController")->except(['index']);

    // typeDocuments routes
    Route::resource("/typeDocuments", "TypeDocumentController")->except(['index']);
    Route::get('/typeDocument/search', "TypeDocumentController@search")->name('typeDocuments.search');

    // plannings routes
    Route::resource("/plannings", "PlanningController");
    Route::get('/plannings/client/search/{id_client}', "PlanningController@clients_planning")->name('plannings.search');
    Route::get("/planningsJson/{id_event}", "PlanningController@showJson");

    // --- show client full envents
    Route::get("/plannings/client/full-events/{id_client}", "PlanningController@clientFullEventsView")->name('client.full_events');
    Route::get("/planningsJsonByClient/{id_client}", "PlanningController@clientFullEventsJson");

    // tickets routes
    Route::resource('/tickets', "TicketController");
    Route::post('/tickets/replied', "TicketController@replied_ticket")->name('tickets.replied.store');
    Route::post('/tickets/closeTicket', "TicketController@closeTicket")->name('tickets.closeTicket');

    // users resource
    Route::resource('/users', "UserController");
    Route::get('user/profile', "UserController@editProfile")->name('user.edit_profile');
    Route::patch('user/updateProfile/{user}', "UserController@updateProfile")->name('user.update_profile');
    Route::patch('user/changePassword/{user}', "UserController@updatePassword")->name('user.change_password');

    // roles resource
    Route::resource('/roles', "RoleController");
    Route::get('/permission/create', "RoleController@newPermission");
    Route::post('/permission/store', 'RoleController@createPermission')->name('permission.store');

});

// -----------------------------
// just to testing some features
// -----------------------------

// Route::get('/test/{id}', function () {
//     // $file = Facture::findOrFail(3);

//     // return response()->make(file_get_contents(public_path($file->chemin)), 200, [
//     //     'Content-Type' => 'application/pdf',
//     //     'Content-Disposition' => 'inline; filename="' . $file->nom_fichier . '"',
//     // ]);
//     $calendar = Planning::where('IDClient', request()->id)->first();
//     $title = "calendar";
//     return view('backend.views.plannings.index', compact("calendar", "title"));

// });

// Route::get('/calendar', function () {
//     $title = "full calendar";
//     return view('backend.views.plannings.calendar.calendar', compact("title"));
// });

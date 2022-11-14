<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Models\Priorite;
use App\Models\Service;
use App\Models\TypeDocument;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:paramètres_index", ['only' => ['settings']]);
    }

    public function welcome()
    {
        return view("backend.views.welcome");
    }

    public function settings()
    {
        $services = Service::all();
        $priorites = Priorite::all();
        $type_documents = TypeDocument::all();

        return view('backend.views.settings', compact('services', 'priorites', 'type_documents'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }
}

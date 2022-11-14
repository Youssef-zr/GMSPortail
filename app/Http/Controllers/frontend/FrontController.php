<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\SendMailRequest;
use App\Mail\FrontSendMail;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function home()
    {
        $title = "accueil";

        return view("frontend.views.index", compact("title"));
    }

    public function contact()
    {
        $title = "contact";

        return view("frontend.views.contact", compact("title"));
    }

    public function sendMail(SendMailRequest $request)
    {
        $data = $request->all();
        Mail::to("yn-neinaa@hotmail.com")->send(new FrontSendMail($data));

        return redirect_with_flash('msgSuccess', "nous avons bien reçu votre message", "/", "not_admin_url");
    }
}

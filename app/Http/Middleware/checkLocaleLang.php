<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class checkLocaleLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->segment(1) == 'dashboard') {
            App::setLocale("fr");
        } else {
            App::setLocale("ar");
        }
        
        return $next($request);
    }
}

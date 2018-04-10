<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class LangSession
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
        if (Session::has('session_lang') && in_array(Session::get('session_lang'), ['en','es']) ) {
            App::setLocale(Session::get('session_lang'));
        }
        
        return $next($request);
    }
}

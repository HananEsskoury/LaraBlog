<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AuteurMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(Auth::check() && Auth::user()->usertype=='auteur'){
             return $next($request);
        }
        abort(403,'unauthorised access');
    }    
       
}

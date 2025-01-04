<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class adminauth
{
    /**
     * Handle an incoming request.
     *
     ** @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            // Si non authentifié, redirige vers la page de connexion
            return redirect()->route('signin');
        }

        return $next($request);
    }
}

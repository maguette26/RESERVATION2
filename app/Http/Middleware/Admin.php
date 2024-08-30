<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the "admin" role
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/login'); // Redirection si l'utilisateur n'est pas admin
    }
}

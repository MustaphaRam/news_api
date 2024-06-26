<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;


class AuthenticateAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        dd(auth()->user());
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Token is valid, proceed with the request
        return $next($request);
    }
}

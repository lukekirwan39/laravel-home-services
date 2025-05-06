<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthSprovider
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->utype === 'SVP') {
            return $next($request); // ✅ Allow access only if SVP
        }
        else {
            session()->flush();
            return redirect()->route('login');
        }
    }
}

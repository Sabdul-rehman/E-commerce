<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminContext
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || $request->user()->role !== 'admin') {
            return redirect()->route('home')
                ->with('error', 'You are not authorized to access admin dashboard.');
        }

        $request->session()->put('auth_context', 'admin');

        return $next($request);
    }
}

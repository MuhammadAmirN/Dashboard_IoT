<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            if (auth()->check() && auth()->user()->role === 'murid') {
                return redirect()->route('murid.dashboard');
            }
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_active === false) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Your account is inactive.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuthorizationHeader
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->headers->has('X-Auth-Token')) {
            $request->headers->set('Authorization', $request->headers->get('X-Auth-Token'));
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Gate;


class IsAdmin
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
        if (Gate::denies('isAdmin')) {
            return redirect('403');
        }

        return $next($request);
    }
}

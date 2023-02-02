<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->user() === null) {
            return response("No User found", 401);
        }
        $actions = $request->route()->getAction();
        //$roles = isset($actions['roles']) ? $actions['roles'] : null;
        if ($request->user()->hasAnyRole($roles) || !$roles) {
            return $next($request);
        }
        return redirect('/access');
        return response("System Error", 401);
    }
}

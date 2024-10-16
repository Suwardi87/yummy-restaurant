<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class MiddlewareService
{
    public function aksesRole()
    {
        return function ($request, $next) {
            if (Auth::user()->role === 'owner' && !in_array($request->routeIs('panel.*'), ['index', 'show', 'transactions.index', 'transactions.download'])) {
                abort(403);
            }

            return $next($request);
        };
    }
}

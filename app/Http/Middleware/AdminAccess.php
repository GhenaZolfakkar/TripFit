<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || (!$user->is_super_admin && !$user->is_agency_admin)) {
            abort(403);
        }

        return $next($request);
    }
}

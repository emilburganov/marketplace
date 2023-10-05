<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed_roles = array_slice(func_get_args(), 2);
        $user = Auth::user();

        if (in_array($user['role_id'], $allowed_roles)) {
            return $next($request);
        }

        return redirect()->back();
    }
}

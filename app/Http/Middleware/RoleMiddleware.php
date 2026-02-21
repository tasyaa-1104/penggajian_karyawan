<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles): Response
    {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Pastikan $roles adalah array
    if (!is_array($roles)) {
        $roles = explode('|', $roles);
    }

    if (!in_array(Auth::user()->role, $roles)) {
        abort(403, 'ANDA TIDAK PUNYA AKSES');
    }

    return $next($request);

    }
}

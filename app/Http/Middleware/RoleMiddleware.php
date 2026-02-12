<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        Log::info('RoleMiddleware check', [
            'requested_role' => $role,
            'is_authenticated' => Auth::check(),
            'user_id' => Auth::id(),
            'user_role' => Auth::user()?->role ?? 'null',
        ]);

        if (!Auth::check()) {
            Log::info('User not authenticated, redirecting to login');
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            Log::warning('User role mismatch', [
                'user_role' => Auth::user()->role,
                'required_role' => $role,
            ]);
            abort(403, 'ANDA TIDAK PUNYA AKSES');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        $user = Auth::user();

        if ($role !== null) {

            if (!$user->role) {
                dd('User tidak punya role');
            }

            if (strtolower($user->role->name) !== strtolower($role)) {
                // return redirect()->route('home');
                abort(403, 'Unauthorized access.');
                // dd('Role user:', $user->role->name, 'dibutuhkan:', $role);
            }
        }

        return $next($request);
    }
}

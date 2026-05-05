<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = $request->user();
        $roles = array_map('trim', explode(',', $roles));

        if (! $user || ! $user->hasAnyRole($roles)) {
            return Redirect::route('dashboard')->with('warning', 'You do not have permission to access that area.');
        }

        return $next($request);
    }
}

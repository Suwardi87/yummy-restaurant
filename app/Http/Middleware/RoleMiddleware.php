<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user && $this->hasRole($user, $role)) {
                return $next($request); // Lanjutkan jika peran cocok
            }
        }

        // Redirect jika tidak memiliki akses
        return redirect('/panel/dashboard')->with('error', 'You do not have access to this page.');
    }

    /**
     * Check if the user has a specific role.
     *
     * @param  \App\Models\User  $user
     * @param  string  $role
     * @return bool
     */
    private function hasRole($user, string $role): bool
    {
        // Logika tambahan untuk memeriksa peran
        if (Session::get('role') === 'owner' && $role === 'operator') {
            return false; // Pemilik tidak bisa menjadi operator
        }

        return $user->role === $role; // Periksa peran pengguna
    }


}

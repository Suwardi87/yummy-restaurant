<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Cek apakah pengguna sudah terautentikasi
        if (!$user) {
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        foreach ($roles as $role) {
            if ($this->hasRole($user, $role)) {
                // Jika owner login, hanya boleh download transaksi dan lihat detail data
                if ($role === 'owner') {
                    if ($request->routeIs('panel.transaction.download')) {
                        return $next($request); // Lanjutkan jika peran cocok dan hanya download transaksi
                    } else {
                        return redirect('/panel/dashboard')->with('error', 'You do not have access to this page.');
                    }
                } else {
                    return $next($request); // Lanjutkan jika peran cocok
                }
            }
        }

        // Redirect jika tidak memiliki akses
        return redirect('/panel/dashboard')->with('error', 'You do not have access to this page.');
    }

    private function hasRole($user, string $role): bool
    {
        return $user->role === $role; // Periksa peran pengguna
    }
}


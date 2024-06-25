<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Asumsikan Anda memiliki kolom `role` pada tabel `users`
        if (!Auth::check() || !in_array(Auth::user()->role, $roles) && !in_array('all', $roles)) {
            return redirect('home'); // Atau halaman akses ditolak lainnya
        }

        return $next($request);
    }
}

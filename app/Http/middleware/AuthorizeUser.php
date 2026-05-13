<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    public function handle(Request $request, Closure $next, ...$role): Response // Gunakan ...$role
    {
        /** @var \App\Models\User $user */ // Tips: Ini untuk menghilangkan garis merah di VS Code
        $user_role= $request->user()->getRole();

        if (in_array($user_role, $role)) {
            return $next($request);
        }

        abort(403, 'Maaf, level Anda adalah ' . ($user->level->level_nama ?? 'Tidak Diketahui') . ' dan tidak diizinkan.');
    }
}
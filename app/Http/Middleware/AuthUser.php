<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web');

        // Check Session
        if (!$user->check()) {
            Alert::error('Oops', 'Sesi berakhir. Silahkan login kembali!');
            return redirect()->route('login');
        }

        // Check User is Active
        if (!$user->user()->is_active == 1) {

            $user->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Alert::error('GAGAL', 'Akun anda tidak aktif atau di blokir! Mohon hubungi administator.');
            return redirect()->route('login');
        }

        // if($user->user()->email_verified_at == NULL) {
        //     Alert::error('GAGAL', 'Akun anda belum di verifikasi.');
        //     return redirect()->route('verification.notice');
        // }

        if ($user->check()) {
            return $next($request);
        }

    }
}

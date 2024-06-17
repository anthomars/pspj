<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        $user = Auth::guard('web')->user();

        if ($user) {
            return redirect()->intended('/user/dashboard');
        }
        return view('auth.pages.login');
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'email'   => 'required|email',
            'password'   => 'required|min:8|max:255',
        ];

        $message = [
            'email.required' => 'Email harus di isi.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password harus di isi.',
            'password.min' => 'Password minimal 8 digit.',
            'password.max' => 'Password maksimal 255 digit.',
        ];

        $credentials = $request->validate($rules, $message);

        // $remember = $request->has('remember') ? true : false;

        $auth = Auth::guard('web');

        if ($auth->attempt($credentials)) {
            // Check User is Active
            if ($auth->user()->is_active) {
                $request->session()->regenerate();

                Alert::success('SUKSES', 'Anda berhasil masuk kedalam sistem!');
                return redirect()->intended('/dashboard');
            } else {
                $auth->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Alert::warning('GAGAL', 'Akun anda telah di blok atau tidak aktif! Mohon hubungi administator.');
                return redirect()->back();
            }
        } else {
            Alert::warning('GAGAL', 'username/email/password yang anda masukan salah, silahkan coba lagi!!');
            return redirect()->back();
        }
    }

    public function register()
    {

        return view('auth.pages.signup');
    }

    public function logout(Request $request)
    {
        $auth = Auth::guard('web');

        if ($auth->check()) // this means that the user was logged in.
        {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        }

        $auth->logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}

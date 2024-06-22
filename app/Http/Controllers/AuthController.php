<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $rt = Rt::all();
        $rw = Rw::all();
        return view('auth.pages.signup',compact('rt', 'rw'));
    }

    public function store(Request $request)
    {
        $rules = [
            'username'  => 'required',
            'nama_lengkap'  => 'required',
            'nik'  => 'required',
            'no_hp'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15|unique:users,no_hp',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|same:confirm_password|string|min:8|max:255',
            'rt_id'     => 'required',
            'rw_id'     => 'required',
            'confirm_password' => 'required'
        ];

        $message = [
            'username.required' => 'Username harus di isi.',
            'nama_lengkap.required' => 'Full Name harus di isi.',
            'nik.required'      => 'NIK harus di isi.',
            'no_hp.required'    => 'No. HP harus di isi.',
            'no_hp.regex'       => 'No. HP harus di isi dengan angka.',
            'no_hp.min'         => 'No. HP harus di isi minimal 8 angka.',
            'no_hp.max'         => 'No. HP harus di isi maksimal 15 angka.',
            'no_hp.unique'      => 'No. HP sudah digunakan.',
            'email.required'    => 'Email harus di isi.',
            'email.email'       => 'Email harus di isi dengan benar.',
            'email.unique'      => 'Email sudah digunakan.',
            'rt.required'       => 'RT Harus di isi.',
            'rw.required'       => 'RW Harus di isi.',
            'password.required' => 'New Password harus di isi.',
            'password.same'     => 'Confirm Password tidak sama.',
            'password.min'      => 'Password minimal 8 digit.',
            'password.max'      => 'Password maksimal 255 digit.',
            'confirm_password.required' => 'Confirm Password harus di isi.',

        ];

        $validatedData = $request->validate($rules, $message);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['date_created'] = now();

        try {
            User::create($validatedData);
        } catch (\Exception $e) {
            Alert::error('Maaf', 'Registrasi Gagal!');
            return redirect('/register');
        }

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $request->password,
        ];

        Auth::attempt($credentials);
        Alert::success('Sukses', 'Registrasi Berhasil!');
        return redirect(route('dashboard.index'));
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

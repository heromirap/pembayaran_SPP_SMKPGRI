<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //Daftar Siswa
    public function daftar(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'nis' => 'required|unique:users,nis',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'telepon' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas' => $request->kelas,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telepon' => $request->telepon,
            'role' => 'siswa',
        ]);

        return redirect()->route('beranda')->with('success', 'Akun berhasil dibuat!');
    }

    // Login Siswa
    public function showSiswaLogin()
    {
        return view('siswa.login');
    }

    public function siswaLoginProcess(Request $request)
{
    $request->validate([
        'nis' => 'required',
        'password' => 'required'
    ], [
        'nis.required' => 'Silakan isi NIS dan Password!',
        'password.required' => 'Silakan isi NIS dan Password!'
    ]);

    $user = User::where('nis', $request->nis)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        if ($user->role === 'siswa') {
            Auth::login($user);
            return redirect()->route('dashboard.siswa');
        } else {
            return back()->withErrors(['login_error' => 'Anda bukan siswa!']);
        }
    }

    return back()->withErrors(['login_error' => 'NIS atau Password salah!']);
}
    //Logout Siswa
    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // kembali ke beranda
}

    // Login Admin
    public function showAdminLogin()
    {
        return view('admin.login_admin');
    }

    public function adminLoginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->role === 'admin') {
                Auth::login($user);
                return redirect()->route('dashboard.admin');
            } else {
                return back()->withErrors(['login_error' => 'Anda bukan admin!']);
            }
        }

        return back()->withErrors(['login_error' => 'Email atau Password salah!']);
    }

}
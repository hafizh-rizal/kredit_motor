<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelangganAuthController extends Controller
{
    public function registerForm()
    {
        return view('pelanggan.auth.register', [
            'title' => 'Form Registrasi Pelanggan'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'kata_kunci' => 'required|string|min:6|confirmed',
            'no_telp' => 'required|string|max:15',
            'alamat1' => 'required|string',
            'kota1' => 'required|string',
            'propinsi1' => 'required|string',
            'kodepos1' => 'required|string',
            'alamat2' => 'nullable|string',
            'kota2' => 'nullable|string',
            'propinsi2' => 'nullable|string',
            'kodepos2' => 'nullable|string',
            'alamat3' => 'nullable|string',
            'kota3' => 'nullable|string',
            'propinsi3' => 'nullable|string',
            'kodepos3' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->kata_kunci = Hash::make($request->kata_kunci);
        $pelanggan->no_telp = $request->no_telp;
        $pelanggan->alamat1 = $request->alamat1;
        $pelanggan->kota1 = $request->kota1;
        $pelanggan->propinsi1 = $request->propinsi1;
        $pelanggan->kodepos1 = $request->kodepos1;
        $pelanggan->alamat2 = $request->alamat2;
        $pelanggan->kota2 = $request->kota2;
        $pelanggan->propinsi2 = $request->propinsi2;
        $pelanggan->kodepos2 = $request->kodepos2;
        $pelanggan->alamat3 = $request->alamat3;
        $pelanggan->kota3 = $request->kota3;
        $pelanggan->propinsi3 = $request->propinsi3;
        $pelanggan->kodepos3 = $request->kodepos3;

        if ($request->hasFile('foto')) {
            $pelanggan->foto = $request->file('foto')->store('pelanggan', 'public');
        }
    
        $pelanggan->save();
    
        return redirect()->route('pelanggan.auth.login')->with('pesan', 'Registrasi berhasil! Silakan login.');
    }

    public function loginForm()
    {
        return view('pelanggan.auth.login', [
            'title' => 'Form Login Pelanggan'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_kunci' => 'required|string',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if ($pelanggan && Hash::check($request->kata_kunci, $pelanggan->kata_kunci)) {
            Auth::guard('pelanggan')->login($pelanggan);
            $request->session()->regenerate();
            return redirect()->route('home.index'); 
        }

        return redirect()->back()->with('error', 'Email atau kata sandi salah.');
    }

    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->forget('pelanggan.auth.logout'); 
        $request->session()->regenerateToken();
        return redirect()->route('home.index');
    }
}

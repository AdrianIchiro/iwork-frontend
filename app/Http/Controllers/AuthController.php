<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register_show() {
        return view('auth.register');
    }

    public function login_show() {
        return view('auth.login');
    }

   public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required|in:EMPLOYER,WORKER',
        ]);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('http://localhost:3000/api/v1/register', $validated);

            if ($response->failed()) {

                $errorMessage = $response->json('message')
                    ?? 'Terjadi kesalahan pada server Authentication.';

                return back()->withErrors([
                    'api_error' => $errorMessage
                ])->withInput();
            }
            return redirect('/login')->with('success', 'Pendaftaran berhasil!');

        } catch (\Exception $e) {
            return back()->withErrors([
                'api_error' => 'Tidak dapat terhubung ke server Authentication.'
            ])->withInput();
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $response = Http::post('http://localhost:3000/api/v1/login', $validated);
        if ($response->failed()) {
                return back()->withErrors([
                    'api_error' => 'Email atau password salah',
                ]);
            }

            $data = $response->json();

            session([
                'token' => $data['token'],
                'user' => $data['user'],
            ]);

            return redirect()->route('index');
    }
}

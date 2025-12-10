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

        $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
        ])->post('http://localhost:3000/api/v1/login', $validated);

        $data = $response->json();

        $user = $data['user'];

        session([
            'token' => $data['token'],
            'user'  => $user,
        ]);

        switch ($user['role']) {
            case 'EMPLOYER':
                return redirect()->route('employer.index');

            case 'WORKER':
                return redirect()->route('main.quest');

            default:
                session()->flush();
                return back()->withErrors([
                    'api_error' => 'Role tidak dikenal.',
                ]);
        }
    }

    public function logout(Request $request)
    {
        session()->flush();

        return redirect()->route('login.show')->with('success', 'Anda telah logout.');
    }

}

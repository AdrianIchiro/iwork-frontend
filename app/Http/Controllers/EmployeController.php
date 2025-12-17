<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeController extends Controller
{
    public function index()
    {
        $user = session('user');

        $userId = session('user')['id'];

        $response = Http::get(env('API_URL') . 'quests');

        $questCount = collect($response->json()['data'] ?? [])
            ->filter(function ($q) use ($userId) {
                return isset($q['employer']['userId'])
                    && $q['employer']['userId'] == $userId;
            })
            ->count();

        return view('employeer.main', compact('user', 'questCount'));
    }

   public function quest()
    {
        $userId = session('user')['id'];

        $response = Http::get(env('API_URL') . 'quests');

        $quests = collect($response->json()['data'] ?? [])
            ->filter(function ($q) use ($userId) {
                return isset($q['employer']['userId']) &&
                    $q['employer']['userId'] == $userId;
            });

        return view('employeer.quest', compact('quests'));
    }


    public function store_quest(Request $request)
    {
        $token = session('token');

       $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->post(env('API_URL') . 'quests', [
            'title'          => $request->title,
            'description'    => $request->description,
            'tier'           => $request->tier,
            'maxSubmissions' => $request->maxSubmissions,
            'deadline'       => $request->deadline,
            'quotaType'      => $request->quotaType,
        ]);

         if ($response->failed()) {

            $apiMessage = $response->json('message');

            if (
                $response->status() === 403 &&
                str_contains(strtolower($apiMessage), 'kuota')
            ) {
                return back()
                    ->withInput()
                    ->with('error', 'Saldo kuota Anda habis. Silakan beli kuota terlebih dahulu.');
            }

            return back()
                ->withInput()
                ->with('error', $apiMessage ?? 'Gagal membuat quest.');
        }

        if ($response->failed()) {
            return back()->with('error', $response->json()['message'] ?? 'Gagal membuat quest.');
        }

        return back()->with('success', 'Quest berhasil dibuat!');
    }

}

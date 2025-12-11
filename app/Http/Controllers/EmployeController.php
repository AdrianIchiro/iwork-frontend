<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeController extends Controller
{
    public function index()
    {
        $user = session('user');

        return view('employeer.main', compact('user'));
    }

   public function quest()
    {
        $userId = session('user')['id'];

        $response = Http::get('http://localhost:3000/api/v1/quests');

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
        ])->post('http://localhost:3000/api/v1/quests', [
            'title'          => $request->title,
            'description'    => $request->description,
            'tier'           => $request->tier,
            'maxSubmissions' => $request->maxSubmissions,
            'deadline'       => $request->deadline,
            'quotaType'      => $request->quotaType,
        ]);


        dd($response);


        if ($response->failed()) {
            return back()->with('error', $response->json()['message'] ?? 'Gagal membuat quest.');
        }

        return back()->with('success', 'Quest berhasil dibuat!');
    }

}

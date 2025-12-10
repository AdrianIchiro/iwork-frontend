<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function quest(Request $request)
    {
        $user = session('user');

        $search = $request->query('search');

        $response = Http::get('http://localhost:3000/api/v1/quests', [
            'search' => $search
        ]);

        $quests = $response->json('data') ?? [];


        $quests = $response->json('data');
        return view('main.quest', compact('user', 'quests', 'search'));
    }
}

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

        $response = Http::get(env('API_URL') . 'quests', [
            'search' => $search
        ]);

        $quests = $response->json('data') ?? [];


        $quests = $response->json('data');
        return view('main.quest', compact('user', 'quests', 'search'));
    }

    public function index()
    {
        $user = session('user');

        return view('main.landing', compact('user'));
    }
}

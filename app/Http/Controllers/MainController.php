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

    public function myQuests(Request $request)
    {
        $user = session('user');
        $token = session('token');

        $response = Http::withToken($token)->get(env('API_URL') . 'quests/my-submissions');

        $submissions = $response->json('data') ?? [];

        // Filter out hidden quests
        $hiddenQuests = session('hidden_quests', []);
        $submissions = array_filter($submissions, function ($submission) use ($hiddenQuests) {
            return !in_array($submission['id'], $hiddenQuests);
        });

        return view('main.my-quests', compact('user', 'submissions'));
    }

    public function bidQuest(Request $request, $questId)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->post(env('API_URL') . 'quests/' . $questId . '/start', []);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => $response->json('message'),
                'data' => $response->json('data')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $response->json('message') ?? 'Gagal mengambil quest.'
        ], $response->status());
    }

    public function submitQuest(Request $request, $questId)
    {
        $token = session('token');

        $request->validate([
            'file' => 'required|file'
        ]);

        $file = $request->file('file');

        $response = Http::withToken($token)
            ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post(env('API_URL') . 'quests/' . $questId . '/submit');

        if ($response->successful()) {
            return back()->with('success', $response->json('message'));
        }

        return back()->withErrors(['submit_error' => $response->json('message') ?? 'Gagal submit quest.']);
    }

    public function hideQuest(Request $request, $submissionId)
    {
        $hiddenQuests = session('hidden_quests', []);

        if (!in_array($submissionId, $hiddenQuests)) {
            $hiddenQuests[] = $submissionId;
            session(['hidden_quests' => $hiddenQuests]);
        }

        return back()->with('success', 'Quest berhasil dihapus dari daftar.');
    }

    public function about()
    {
        $user = session('user');

        return view('main.about', compact('user'));
    }
}

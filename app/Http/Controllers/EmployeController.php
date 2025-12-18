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

    public function job()
    {
         $userId = session('user')['id'];
         $token  = session('token');

         $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
        ])->get(env('API_URL') . 'jobs');

            $jobs = collect($response->json()['data'] ?? [])
                ->filter(function ($job) use ($userId) {
                    return isset($job['employer']['userId'])
                        && $job['employer']['userId'] == $userId;
                });

            return view('employeer.job', compact('jobs'));
    }

    public function store_job(Request $request)
    {
        $token = session('token');


        $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
            'location'    => 'required|string',
            'salary'      => 'required|numeric',
            'jobType'     => 'required|string',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->post(env('API_URL') . 'jobs', [
            'title'          => $request->title,
            'description'    => $request->description,
            'location'       => $request->location,
            'salary'         => $request->salary,
            'jobType'        => $request->jobType,
            'maxApplicants' => $request->maxApplicants,
            'deadline'       => $request->deadline,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
        ]);

        if ($response->failed()) {
            return back()
                ->withInput()
                ->with('error', $response->json('message') ?? 'Gagal membuat job.');
        }


        $paymentUrl = $response->json('payment.redirect_url');

        if ($paymentUrl) {
            return redirect()->away($paymentUrl);
        }

        return back()->with('success', 'Job berhasil dibuat.');
    }

}

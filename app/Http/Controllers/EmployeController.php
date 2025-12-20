<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeController extends Controller
{
    public function index()
    {
        $user = session('user');
        $token = session('token');
        $userId = session('user')['id'];

        // Get quest count
        $response = Http::get(env('API_URL') . 'quests');

        $questCount = collect($response->json()['data'] ?? [])
            ->filter(function ($q) use ($userId) {
                return isset($q['employer']['userId'])
                    && $q['employer']['userId'] == $userId;
            })
            ->count();

        // Get employer stats (one-time quota and total submissions)
        $statsResponse = Http::withToken($token)->get(env('API_URL') . 'employer/stats');
        $stats = $statsResponse->json('data') ?? [];

        $onetimeQuota = $stats['onetimeQuota'] ?? 0;
        $totalSubmissions = $stats['totalSubmissions'] ?? 0;
        $subscription = $stats['subscription'] ?? null;

        return view('employeer.main', compact('user', 'questCount', 'onetimeQuota', 'totalSubmissions', 'subscription'));
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
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(env('API_URL') . 'quests', [
                    'title' => $request->title,
                    'description' => $request->description,
                    'tier' => $request->tier,
                    'maxSubmissions' => $request->maxSubmissions,
                    'deadline' => $request->deadline,
                    'quotaType' => $request->quotaType,
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

    public function managePlan()
    {
        $user = session('user');
        return view('employeer.manage-plan', compact('user'));
    }

    public function submissions()
    {
        $user = session('user');
        $token = session('token');

        $response = Http::withToken($token)->get(env('API_URL') . 'quests/employer-submissions');

        // Debug: Log the response
        \Log::info('Employer Submissions API Response', [
            'status' => $response->status(),
            'body' => $response->json(),
            'token' => $token ? 'present' : 'missing'
        ]);

        $quests = $response->json('data') ?? [];

        return view('employeer.submissions', compact('user', 'quests'));
    }

    public function assessSubmission(Request $request, $submissionId)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->put(env('API_URL') . 'submissions/' . $submissionId . '/assess', [
                'isApproved' => $request->isApproved === 'true',
                'rating' => (int) $request->rating,
                'feedback' => $request->feedback,
            ]);

        if ($response->successful()) {
            return back()->with('success', 'Assessment berhasil disimpan!');
        }

        return back()->withErrors(['assess_error' => $response->json('message') ?? 'Gagal menyimpan assessment.']);
    }

    public function updateQuest(Request $request, $questId)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->put(env('API_URL') . 'quests/' . $questId, [
                'title' => $request->title,
                'description' => $request->description,
                'tier' => $request->tier,
                'maxSubmissions' => $request->maxSubmissions,
                'deadline' => $request->deadline,
            ]);

        if ($response->failed()) {
            dd([
                'url' => env('API_URL') . 'quests/' . $questId,
                'status' => $response->status(),
                'error_from_api' => $response->json(),
                'sent_data' => $request->all()
            ]);
        }

        if ($response->successful()) {
            return back()->with('success', 'Quest berhasil diupdate!');
        }

        return back()->with('error', $response->json('message') ?? 'Gagal mengupdate quest.');
    }

    public function deleteQuest($questId)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->delete(env('API_URL') . 'quests/' . $questId);

        if ($response->successful()) {
            return back()->with('success', 'Quest berhasil dihapus!');
        }

        return back()->with('error', $response->json('message') ?? 'Gagal menghapus quest.');
    }



    public function job()
    {
        $userId = session('user')['id'];
        $token = session('token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
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
            'title' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'required|numeric',
            'jobType' => 'required|string',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(env('API_URL') . 'jobs', [
                    'title' => $request->title,
                    'description' => $request->description,
                    'location' => $request->location,
                    'salary' => $request->salary,
                    'jobType' => $request->jobType,
                    'maxApplicants' => $request->maxApplicants,
                    'deadline' => $request->deadline,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
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

    /**
     * Buy a subscription plan (ENTRY, MID, or HIGH)
     */
    public function buySubscription(Request $request)
    {
        $token = session('token');

        $request->validate([
            'tier' => 'required|in:ENTRY,MID,HIGH',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(env('API_URL') . 'subscriptions', [
                    'tier' => $request->tier,
                ]);

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Gagal memproses langganan.');
        }

        $paymentUrl = $response->json('payment.redirect_url');

        if ($paymentUrl) {
            return redirect()->away($paymentUrl);
        }

        return back()->with('error', 'Tidak dapat memproses pembayaran.');
    }

    /**
     * Buy one-time quota
     */
    public function buyQuota(Request $request)
    {
        $token = session('token');

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(env('API_URL') . 'quotas', [
                    'quantity' => (int) $request->quantity,
                ]);

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Gagal memproses pembelian kuota.');
        }

        $paymentUrl = $response->json('payment.redirect_url');

        if ($paymentUrl) {
            return redirect()->away($paymentUrl);
        }

        return back()->with('error', 'Tidak dapat memproses pembayaran.');
    }
}

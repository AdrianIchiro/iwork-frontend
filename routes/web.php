<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\EmployeController;


Route::middleware('auth.check')->group(function () {
    Route::get('/register', [AuthController::class, 'register_show'])->name('register.show');
    Route::get('/login', [AuthController::class, 'login_show'])->name('login.show');

    Route::post('/register', [AuthController::class, 'register'])->name('register.action');
    Route::post('/login', [AuthController::class, 'login'])->name('login.action');
});

Route::middleware(['auth.identify', 'auth.employer'])->group(function () {
    Route::get('/employee', [EmployeController::class, 'index'])->name('employer.index');
    Route::get('/employee/quest', [EmployeController::class, 'quest'])->name('employer.quest');
    Route::post('/employee/quest', [EmployeController::class, 'store_quest'])->name('quest.store');
    Route::put('/employee/quest/{questId}', [EmployeController::class, 'updateQuest'])->name('quest.update');
    Route::delete('/employee/quest/{questId}', [EmployeController::class, 'deleteQuest'])->name('quest.delete');
    Route::get('/employee/manage-plan', [EmployeController::class, 'managePlan'])->name('employer.manage-plan');
    Route::get('/employee/submissions', [EmployeController::class, 'submissions'])->name('employer.submissions');
    Route::post('/employee/submissions/{submissionId}/assess', [EmployeController::class, 'assessSubmission'])->name('employer.assess');
    Route::get('/employee/job', [EmployeController::class, 'job'])->name('employer.job');
    Route::post('/employee/job', [EmployeController::class, 'store_job'])->name('job.store');
    Route::get('/employee/job/{jobId}', [EmployeController::class, 'jobDetail'])->name('employer.job.detail');
    Route::get('/employee/job/{jobId}/applicants', [EmployeController::class, 'jobApplicants'])->name('employer.job.applicants');
    Route::patch('/employee/applications/{applicationId}', [EmployeController::class, 'updateApplicationStatus'])->name('employer.application.update');
    Route::post('/employee/subscription', [EmployeController::class, 'buySubscription'])->name('employer.subscription.buy');
    Route::post('/employee/quota', [EmployeController::class, 'buyQuota'])->name('employer.quota.buy');
});

Route::middleware(['auth.identify', 'auth.worker'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main.index');
    Route::get('/quest', [MainController::class, 'quest'])->name('main.quest');
    Route::get('/my-quests', [MainController::class, 'myQuests'])->name('main.my-quests');
    Route::post('/quest/{questId}/bid', [MainController::class, 'bidQuest'])->name('quest.bid');
    Route::post('/quest/{questId}/submit', [MainController::class, 'submitQuest'])->name('quest.submit');
    Route::post('/quest/{submissionId}/hide', [MainController::class, 'hideQuest'])->name('quest.hide');
    Route::get('/about', [MainController::class, 'about'])->name('main.about');
    Route::get('/jobs', [MainController::class, 'jobs'])->name('main.jobs');
    Route::post('/jobs/{jobId}/apply', [MainController::class, 'applyJob'])->name('job.apply');
    Route::get('/my-jobs', [MainController::class, 'myJobs'])->name('main.my-jobs');
});


Route::middleware(['auth.identify'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
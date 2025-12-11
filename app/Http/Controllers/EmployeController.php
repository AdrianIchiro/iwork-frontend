<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        $user = session('user');

        return view('employeer.main', compact('user'));
    }

    public function quest()
    {
        return view('employeer.quest');
    }
}

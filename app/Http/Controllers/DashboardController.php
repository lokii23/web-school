<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Return the dashboard view with the user's name
        return view('dashboard', compact('user'));
    }
}

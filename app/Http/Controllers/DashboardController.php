<?php

namespace App\Http\Controllers;

use App\Models\Fan;
use App\Models\FanHistory;

class DashboardController extends Controller
{
    public function index()
    {
        $fans = Fan::latest()->get();
        return view('dashboard.index', compact('fans'));
    }

    public function history()
    {
        $histories = FanHistory::with('fan')->latest('recorded_at')->paginate(15);
        return view('dashboard.history', compact('histories'));
    }
}

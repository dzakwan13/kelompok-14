<?php

namespace App\Http\Controllers;

use App\Models\Fan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $fans = Fan::with('setting')->get();

        $totalFans = Fan::count();

        $runningFans = Fan::where('status', 'Menyala')->count();

        $offFans = $totalFans - $runningFans;

        return view('dashboard.index', compact(
            'fans',
            'totalFans',
            'runningFans',
            'offFans'
        ));
    }
}
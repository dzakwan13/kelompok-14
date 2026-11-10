<?php

namespace App\Http\Controllers;

use App\Models\FanHistory;
use Illuminate\View\View;

class FanHistoryController extends Controller
{
    public function index(): View
    {
        $histories = FanHistory::with('fan')
            ->latest()
            ->paginate(10);

        return view('histories.index', compact('histories'));
    }
}

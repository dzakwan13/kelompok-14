<?php

namespace App\Http\Controllers;

use App\Models\Fan;
use App\Models\FanHistory;
use Illuminate\Http\Request;

class FanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'device_code' => ['required', 'string', 'max:100', 'unique:fans,device_code'],
            'threshold' => ['required', 'numeric', 'between:10,80'],
        ]);

        $fan = Fan::create($data + [
            'temperature' => 0,
            'is_on' => false,
            'speed' => 0,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Kipas berhasil ditambahkan.');
    }

    public function edit(Fan $fan)
    {
        return view('dashboard.edit', compact('fan'));
    }

    public function update(Request $request, Fan $fan)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'device_code' => ['required', 'string', 'max:100', 'unique:fans,device_code,' . $fan->id],
            'threshold' => ['required', 'numeric', 'between:10,80'],
        ]);
        $fan->update($data);
        return redirect()->route('dashboard.index')->with('success', 'Data kipas berhasil diperbarui.');
    }

    public function destroy(Fan $fan)
    {
        $fan->delete();
        return redirect()->route('dashboard.index')->with('success', 'Kipas berhasil dihapus.');
    }
}

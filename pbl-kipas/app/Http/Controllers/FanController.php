<?php

namespace App\Http\Controllers;

use App\Models\Fan;
use App\Models\FanSetting;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class FanController extends Controller
{
    public function index(): View
    {
        $fans = Fan::with('setting')->get();

        return view('fans.index', compact('fans'));
    }

    public function create(): View
    {
        return view('fans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi informasi dasar perangkat
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'device_id' => 'required|string|max:255|unique:fans,device_id',
            'mode' => 'required|in:otomatis,manual',
        ]);

        // Validasi berdasarkan mode yang dipilih
        if ($validated['mode'] === 'otomatis') {
            $validatedRules = $request->validate([
                'rules' => 'required|array|min:1',
                'rules.*.temperature_threshold' => 'required|numeric|between:20,45|distinct',
                'rules.*.fan_speed' => 'required|integer|between:0,100',
            ]);

            $rules = collect($validatedRules['rules'])
                ->sortBy('temperature_threshold')
                ->values()
                ->all();

            $temperatureLimit = $rules[0]['temperature_threshold'];
            $manualSpeed = 0;

        } else {
            $validatedManual = $request->validate([
                'manual_speed' => 'required|integer|between:0,100',
            ]);

            $rules = [];
            $temperatureLimit = 28;
            $manualSpeed = $validatedManual['manual_speed'];
        }

        DB::transaction(function () use (
            $validated,
            $rules,
            $temperatureLimit,
            $manualSpeed
        ) {
            $fan = Fan::create([
                'name' => $validated['name'],
                'device_id' => $validated['device_id'],
                'status' => $manualSpeed > 0 ? 'Menyala' : 'Mati',
                'speed' => $manualSpeed,
            ]);

            $setting = FanSetting::create([
                'fan_id' => $fan->id,
                'mode' => $validated['mode'],
                'temperature_limit' => $temperatureLimit,
                'speed' => $manualSpeed,
            ]);

            // Simpan aturan suhu jika mode otomatis
            foreach ($rules as $rule) {
                $setting->speedRules()->create([
                    'temperature_threshold' => $rule['temperature_threshold'],
                    'fan_speed' => $rule['fan_speed'],
                ]);
            }
        });

        return redirect()
            ->route('fans.index')
            ->with('success', 'Perangkat kipas berhasil ditambahkan.');
    }

    public function edit(Fan $fan): View
    {
        $fan->load('setting.speedRules');

        return view('fans.edit', compact('fan'));
    }

    public function update(Request $request, Fan $fan): RedirectResponse
    {
        // Validasi informasi dasar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'device_id' => 'required|string|max:255|unique:fans,device_id,' . $fan->id,
            'mode' => 'required|in:otomatis,manual',
        ]);

        // Validasi sesuai mode
        if ($validated['mode'] === 'otomatis') {
            $validatedRules = $request->validate([
                'rules' => 'required|array|min:1',
                'rules.*.temperature_threshold' => 'required|numeric|between:20,45|distinct',
                'rules.*.fan_speed' => 'required|integer|between:0,100',
            ]);

            $rules = collect($validatedRules['rules'])
                ->sortBy('temperature_threshold')
                ->values()
                ->all();

            $temperatureLimit = $rules[0]['temperature_threshold'];
            $manualSpeed = 0;

        } else {
            $validatedManual = $request->validate([
                'manual_speed' => 'required|integer|between:0,100',
            ]);

            $rules = [];
            $temperatureLimit = 28;
            $manualSpeed = $validatedManual['manual_speed'];
        }

        DB::transaction(function () use (
            $validated,
            $fan,
            $rules,
            $temperatureLimit,
            $manualSpeed
        ) {
            $fan->update([
                'name' => $validated['name'],
                'device_id' => $validated['device_id'],
                'status' => $manualSpeed > 0 ? 'Menyala' : 'Mati',
                'speed' => $manualSpeed,
            ]);

            $setting = $fan->setting()->updateOrCreate(
                ['fan_id' => $fan->id],
                [
                    'mode' => $validated['mode'],
                    'temperature_limit' => $temperatureLimit,
                    'speed' => $manualSpeed,
                ]
            );

            // Hapus aturan lama sebelum menyimpan aturan terbaru
            $setting->speedRules()->delete();

            foreach ($rules as $rule) {
                $setting->speedRules()->create([
                    'temperature_threshold' => $rule['temperature_threshold'],
                    'fan_speed' => $rule['fan_speed'],
                ]);
            }
        });

        return redirect()
            ->route('fans.index')
            ->with('success', 'Perangkat kipas berhasil diperbarui.');
    }

    public function destroy(Fan $fan): RedirectResponse
    {
        $fan->delete();

        return redirect()
            ->route('fans.index')
            ->with('success', 'Perangkat kipas berhasil dihapus.');
    }

    public function show(Fan $fan): View
    {
        $fan->load('setting.speedRules');

        return view('fans.show', compact('fan'));
    }
}

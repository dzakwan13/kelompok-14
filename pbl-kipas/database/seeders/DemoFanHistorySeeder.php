<?php

namespace Database\Seeders;

use App\Models\Fan;
use App\Models\FanHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoFanHistorySeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Hapus hanya riwayat simulasi sebelumnya.
            FanHistory::where('is_simulated', true)->delete();

            $fans = Fan::with('setting.speedRules')->get();

            // Contoh suhu untuk pengujian demo.
            $samples = [26, 28, 30, 32, 29];

            foreach ($fans as $fan) {

                foreach ($samples as $index => $temperature) {

                    $speed = 0;

                    if ($fan->setting?->mode === 'manual') {

                        $speed = $fan->setting->speed;

                    } elseif ($fan->setting?->mode === 'otomatis') {

                        $rules = $fan->setting->speedRules
                            ->sortBy('temperature_threshold');

                        foreach ($rules as $rule) {
                            if ($temperature >= $rule->temperature_threshold) {
                                $speed = $rule->fan_speed;
                            }
                        }
                    }

                    $status = $speed > 0 ? 'Menyala' : 'Mati';

                    $historyTime = now()->subMinutes(
                        (count($samples) - $index) * 10
                    );

                    FanHistory::create([
                        'fan_id' => $fan->id,
                        'temperature' => $temperature,
                        'status' => $status,
                        'speed' => $speed,
                        'is_simulated' => true,
                        'created_at' => $historyTime,
                        'updated_at' => $historyTime,
                    ]);
                }
            }
        });
    }
}

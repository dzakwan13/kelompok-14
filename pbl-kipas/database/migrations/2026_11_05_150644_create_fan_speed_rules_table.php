<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fan_speed_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fan_setting_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('temperature_threshold', 5, 2);
            $table->unsignedTinyInteger('fan_speed');

            $table->timestamps();

            $table->unique([
                'fan_setting_id',
                'temperature_threshold'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fan_speed_rules');
    }
};

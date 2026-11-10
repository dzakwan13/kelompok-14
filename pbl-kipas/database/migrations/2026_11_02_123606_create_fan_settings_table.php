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
        Schema::create('fan_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fan_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('mode')->default('otomatis');
            $table->decimal('temperature_limit', 5, 2)->default(27);
            $table->unsignedTinyInteger('speed')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fan_settings');
    }
};

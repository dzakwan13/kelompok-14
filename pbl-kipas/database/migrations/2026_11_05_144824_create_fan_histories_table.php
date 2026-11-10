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
        Schema::create('fan_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('temperature', 5, 2);
            $table->string('status');
            $table->unsignedTinyInteger('speed')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fan_histories');
    }
};

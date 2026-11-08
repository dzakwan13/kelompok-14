<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fan_id')->nullable()->constrained('fans')->nullOnDelete();
            $table->decimal('temperature', 5, 2);
            $table->boolean('is_on')->default(false);
            $table->unsignedTinyInteger('speed')->default(0);
            $table->string('note')->nullable();
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
            $table->index('recorded_at');
        });
    }

    public function down(): void { Schema::dropIfExists('fan_histories'); }
};

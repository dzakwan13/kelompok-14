<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('device_code')->unique();
            $table->decimal('temperature', 5, 2)->default(0);
            $table->boolean('is_on')->default(false);
            $table->unsignedTinyInteger('speed')->default(0);
            $table->decimal('threshold', 5, 2)->default(28);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('fans'); }
};

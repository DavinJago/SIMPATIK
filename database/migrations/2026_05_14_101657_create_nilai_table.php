<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('kelas');
            $table->integer('nilai');
            $table->string('grade');
            $table->integer('kehadiran')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('nilai');
    }
};
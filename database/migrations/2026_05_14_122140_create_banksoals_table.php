<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('banksoals', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->integer('jumlah_soal');
            $table->string('praktikum')->nullable();
            $table->string('mata_kuliah')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('banksoals');
    }
};
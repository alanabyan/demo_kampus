<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('materi_id')->constrained('materi')->cascadeOnDelete();
            $table->unsignedTinyInteger('nilai');
            $table->timestamps();
            $table->unique(['mahasiswa_id', 'materi_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};

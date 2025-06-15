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
        Schema::create('hasil_perhitungans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perhitungan');
            $table->foreignId('user_id')->constrained();
            $table->json('data_perhitungan');
            $table->json('hasil_perangkingan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_perhitungans');
    }
};

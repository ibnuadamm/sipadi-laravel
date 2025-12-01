<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemantauan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persediaan_id')->constrained('persediaan')->cascadeOnDelete();

            // kolom baru
            $table->string('lahan')->nullable();

            $table->date('tanggal_tanam');
            $table->integer('jumlah_tanam')->default(0);

            $table->date('tanggal_panen')->nullable();
            $table->integer('jumlah_panen')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemantauan');
    }
};

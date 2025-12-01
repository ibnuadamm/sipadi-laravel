<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beban', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                // tanggal beban
            $table->string('nama_beban');           // nama atau jenis beban
            $table->decimal('nominal', 15, 2);      // nominal biaya
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beban');
    }
};

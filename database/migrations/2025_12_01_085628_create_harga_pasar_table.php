<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('harga_pasar', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('produk');
            $table->decimal('harga', 15, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga_pasar');
    }
};

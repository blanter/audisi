<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('showcases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peserta');
            $table->unsignedBigInteger('id_juri');
            $table->json('penilaian'); // Simpan sebagai array JSON
            $table->integer('total_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showcases');
    }
};

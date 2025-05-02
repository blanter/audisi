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
        Schema::create('assessment_configs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_karya'); // 'Showcase' atau 'Video' atau 'Stage'
            $table->string('level'); // 'beginner' atau 'intermediate'
            $table->string('art_type'); // Contoh: "Menggambar", "Pottery"
            $table->string('title'); // Judul penilaian (e.g. "Sketsa")
            $table->enum('type', ['checkbox', 'radio']);
            $table->json('options'); // label dan value sebagai array
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_configs');
    }
};

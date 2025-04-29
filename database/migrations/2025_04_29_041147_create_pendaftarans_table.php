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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('judul');
            $table->enum('jenis_karya', ['Stage', 'Showcase', 'Video']);
            $table->enum('tema', ['alam', 'sosial', 'english', 'forum', 'campuran']);
            $table->string('storyboard_path');
            $table->string('penilaian_guru_path');
            $table->string('perkiraan_durasi');
            $table->text('list_prop');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};

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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); 
            $table->string('nisn')->unique(); 
            $table->enum('jk', ['L', 'P']); 
            $table->string('alamat'); 
            $table->string('no_telp'); // Kolom untuk nomor telepon siswa
            $table->string('nama_orgtua'); // Kolom untuk nama orang tua
            $table->bigInteger('lokal_id')->unsigned(); // Relasi ke tabel lokal
            $table->bigInteger('user_id')->unsigned(); // Relasi ke tabel lokal
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
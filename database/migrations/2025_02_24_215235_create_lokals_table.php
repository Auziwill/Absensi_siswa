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
        Schema::create('lokals', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); 
            $table->string('tingkat_kelas'); 
            $table->string('kapasitas_siswa'); 
            $table->string('tahun_ajaran'); 
            $table->string('jadwal_pelajaran'); 
            $table->string('kode')->unique(); // Kode unik untuk lokal
            $table->bigInteger('guru_id')->unsigned();
            $table->bigInteger('jurusan_id')->unsigned();
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokals');
    }
};
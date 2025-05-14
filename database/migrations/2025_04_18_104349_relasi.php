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
        //
        Schema::table('absensis',function(Blueprint $table){
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('id_guru')->references('id')->on('gurus')->onDelete('cascade');
        });

        Schema::table('siswas',function(Blueprint $table){
           $table->foreign('lokal_id')->references('id')->on('lokals')->onDelete('cascade');
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('lokals',function(Blueprint $table){
           $table->foreign('id_guru')->references('id')->on('gurus')->onDelete('cascade');
           $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
        });
        Schema::table('gurus',function(Blueprint $table){
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('pengajuans',function(Blueprint $table){
           $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
           $table->foreign('id_guru')->references('id')->on('gurus')->onDelete('cascade');
        });
        Schema::table('notifications',function(Blueprint $table){
           $table->foreign('id_pengajuan')->references('id')->on('pengajuans')->onDelete('cascade');
           $table->foreign('id_guru')->references('id')->on('gurus')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
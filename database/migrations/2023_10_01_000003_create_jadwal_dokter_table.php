<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalDokterTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter');
            $table->string('spesialis');
            $table->text('background_dokter')->nullable();
            $table->json('jadwal_dokter'); // Menyimpan array jadwal dokter dalam format JSON
            $table->json('edukasi_karir'); // Menyimpan array edukasi/karir dalam format JSON
            $table->string('foto')->nullable(); // Upload foto
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_dokter');
    }
}

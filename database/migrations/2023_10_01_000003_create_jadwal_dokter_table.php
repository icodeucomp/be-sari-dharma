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
            $table->unsignedBigInteger('dokter_id'); // Rubah dari nama_dokter menjadi dokter_id
            $table->unsignedBigInteger('spesialis_id'); // Rubah dari spesialis menjadi spesialis_id
            $table->text('background_dokter')->nullable();
            $table->json('jadwal_dokter'); // Menyimpan array jadwal dokter dalam format JSON
            $table->json('edukasi_karir'); // Menyimpan array edukasi/karir dalam format JSON
            $table->string('foto')->nullable(); // Upload foto
            $table->timestamps();

            // Tambahkan foreign keys
            $table->foreign('dokter_id')->references('id')->on('master_dokter')->onDelete('cascade');
            $table->foreign('spesialis_id')->references('id')->on('layanan_spesialis')->onDelete('cascade');

            // Unique constraint untuk mencegah duplikasi data
            $table->unique(['dokter_id', 'spesialis_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_dokter');
    }
}

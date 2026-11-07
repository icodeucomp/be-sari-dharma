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
            $table->unsignedBigInteger('dokter_id');
            $table->unsignedBigInteger('spesialis_id');
            $table->text('background_dokter')->nullable();
            $table->json('jadwal_dokter');
            $table->json('edukasi_karir');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('dokter_id')->references('id')->on('master_dokter')->onDelete('cascade');
            $table->foreign('spesialis_id')->references('id')->on('layanan_spesialis')->onDelete('cascade');

            $table->unique(['dokter_id', 'spesialis_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_dokter');
    }
}

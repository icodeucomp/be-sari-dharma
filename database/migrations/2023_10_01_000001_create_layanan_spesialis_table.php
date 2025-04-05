<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananSpesialisTable extends Migration
{
    public function up()
    {
        Schema::create('layanan_spesialis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->text('deskripsi')->nullable();
            $table->string('icon');
            $table->json('dokter'); // Menyimpan array dokter dalam format JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanan_spesialis');
    }
}

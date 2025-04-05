<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananFasilitasTable extends Migration
{
    public function up()
    {
        Schema::create('layanan_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas');
            $table->text('deskripsi_overview')->nullable();
            $table->text('layanan_fasilitas')->nullable();
            $table->string('foto_header')->nullable();
            $table->string('foto_lainnya')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanan_fasilitas');
    }
}

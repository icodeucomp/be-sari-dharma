<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelKesehatanTable extends Migration
{
    public function up()
    {
        Schema::create('artikel_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('master_kategori')->onDelete('cascade');
            $table->string('judul');
            $table->text('konten');
            $table->json('dokter_terkait')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikel_kesehatan');
    }
}

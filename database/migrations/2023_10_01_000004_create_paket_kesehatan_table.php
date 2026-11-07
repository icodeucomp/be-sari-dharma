<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketKesehatanTable extends Migration
{
    public function up()
    {
        Schema::create('paket_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('master_kategori')->onDelete('cascade');
            $table->string('nama_paket');
            $table->boolean('promo')->default(false);
            $table->date('berlaku_sampai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket_kesehatan');
    }
}

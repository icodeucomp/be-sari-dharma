<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('master_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // "flag" berfungsi untuk menampung informasi kategori yang menunjuk halaman spesifik,
            // misalnya: 'PaketKesehatan, ArtikelKesehatan, EventCommunity'
            $table->string('flag');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_kategori');
    }
}

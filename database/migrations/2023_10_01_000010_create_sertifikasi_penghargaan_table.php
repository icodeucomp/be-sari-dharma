<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSertifikasiPenghargaanTable extends Migration
{
    public function up()
    {
        Schema::create('sertifikasi_penghargaan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('file_pdf')->nullable(); // Upload PDF
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sertifikasi_penghargaan');
    }
}

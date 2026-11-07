<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorMutuTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_mutu', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_mutu');
    }
}

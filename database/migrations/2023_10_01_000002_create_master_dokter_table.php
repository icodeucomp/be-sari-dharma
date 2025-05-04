<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDokterTable extends Migration
{
    public function up()
    {
        Schema::create('master_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_dokter');
    }
}

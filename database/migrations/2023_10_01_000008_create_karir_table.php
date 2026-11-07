<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKarirTable extends Migration
{
    public function up()
    {
        Schema::create('karir', function (Blueprint $table) {
            $table->id();
            $table->string('divisi');
            $table->string('posisi');
            $table->string('link_pendaftaran');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karir');
    }
}

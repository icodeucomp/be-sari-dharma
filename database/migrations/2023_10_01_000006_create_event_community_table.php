<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCommunityTable extends Migration
{
    public function up()
    {
        Schema::create('event_community', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('master_kategori')->onDelete('cascade');
            $table->string('judul');
            $table->text('konten');
            $table->string('foto')->nullable(); // Upload foto
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_community');
    }
}

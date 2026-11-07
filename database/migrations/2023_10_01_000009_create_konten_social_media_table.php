<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenSocialMediaTable extends Migration
{
    public function up()
    {
        Schema::create('konten_social_media', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['youtube', 'instagram']);
            $table->json('links');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konten_social_media');
    }
}

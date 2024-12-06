<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesatuansTable extends Migration
{
    public function up()
    {
        Schema::create('kesatuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kesatuan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kesatuans');
    }
}




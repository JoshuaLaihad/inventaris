<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkcksTable extends Migration
{
    public function up()
    {
        Schema::create('skcks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kesatuan_id')->constrained()->onDelete('cascade'); // Foreign key ke kesatuans
            $table->foreignId('status_id')->constrained()->onDelete('cascade'); // Foreign key ke statuses
            $table->date('tanggal'); // Tanggal
            $table->string('no_box'); // Nomor Box
            $table->string('no_reg'); // Nomor Registrasi
            $table->integer('jumlah'); // Jumlah SKCK
            $table->text('keterangan')->nullable(); // Keterangan opsional
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('skcks');
    }
}



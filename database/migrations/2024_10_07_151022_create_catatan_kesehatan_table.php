<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanKesehatanTable extends Migration
{
    public function up()
    {
        Schema::create('catatan_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mengaitkan ke pengguna
            $table->integer('umur');
            $table->string('kategori');
            $table->float('gula');
            $table->float('sistolik');
            $table->float('diastolik');
            $table->float('berat');
            $table->float('tinggi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catatan_kesehatan');
    }
}

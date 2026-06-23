<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengingat_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('obat'); // Sesuaikan dengan nama input dari modal
            $table->integer('jml_obat'); // Sesuaikan dengan nama input dari modal
            $table->string('jenis_obat'); // Sesuaikan dengan nama input dari modal
            $table->date('tanggal'); // Sesuaikan dengan nama input dari modal
            $table->time('pukul'); // Sesuaikan dengan nama input dari modal
            $table->enum('kategori', ['Sebelum', 'Sesudah']); // Sesuaikan dengan nama input dari modal
            $table->enum('status', ['Menunggu', 'Sudah', 'Terlewatkan'])->default('Menunggu'); // Tambahkan default
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengingat_obats');
    }
};

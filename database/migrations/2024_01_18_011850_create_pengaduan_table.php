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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->bigIncrements('id_pengaduan');
            $table->string('judul_pengaduan');
            $table->string('lokasi_pengaduan');
            $table->unsignedBigInteger('id_user');
            $table->text('deskripsi_pengaduan');
            $table->boolean('IsDelete')->default(0);
            $table->enum('IsApproved', [0, 1, 2])->default(0);

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};

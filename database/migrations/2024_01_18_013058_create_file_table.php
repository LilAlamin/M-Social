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
        Schema::create('file', function (Blueprint $table) {
            $table->bigIncrements('id_file');
            // $table->string('nama_dokumen')->nullable();
            $table->string('nama_file')->nullable();
            $table->unsignedBigInteger('id_pengaduan')->nullable();
            $table->boolean('IsDelete')->default(0);
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file');
    }
};

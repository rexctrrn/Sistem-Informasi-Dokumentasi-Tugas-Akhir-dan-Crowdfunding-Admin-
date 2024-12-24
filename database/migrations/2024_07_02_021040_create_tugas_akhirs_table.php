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
        Schema::create('tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->string("nim");
            $table->string("penulis");
            $table->string("prodi");
            $table->foreignId("pembimbing_1");
            $table->foreignId("pembimbing_2");
            $table->string("judul");
            $table->longText("abstract");
            $table->string("file");
            $table->string("tahun");
            $table->string("kata_kunci")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhirs');
    }
};

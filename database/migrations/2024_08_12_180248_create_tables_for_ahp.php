<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesForAhp extends Migration
{
    public function up()
    {
        // Tabel Kriteria
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Tabel Alternatif
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Tabel Perbandingan Kriteria
        Schema::create('criteria_comparisons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id_1');
            $table->unsignedBigInteger('criteria_id_2');
            $table->float('value');
            $table->timestamps();

            // Foreign key untuk criteria_id_1
            $table->foreign('criteria_id_1')->references('id')->on('criteria')->onDelete('cascade');
            // Foreign key untuk criteria_id_2
            $table->foreign('criteria_id_2')->references('id')->on('criteria')->onDelete('cascade');

            // Menambahkan unique constraint untuk kombinasi criteria_id_1 dan criteria_id_2
            $table->unique(['criteria_id_1', 'criteria_id_2']);
        });

        // Tabel Perbandingan Alternatif
        Schema::create('alternative_comparisons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('alternative_id_1');
            $table->unsignedBigInteger('alternative_id_2');
            $table->float('value');
            $table->timestamps();

            // Foreign key untuk criteria_id
            $table->foreign('criteria_id')->references('id')->on('criteria')->onDelete('cascade');
            // Foreign key untuk alternative_id_1
            $table->foreign('alternative_id_1')->references('id')->on('alternatives')->onDelete('cascade');
            // Foreign key untuk alternative_id_2
            $table->foreign('alternative_id_2')->references('id')->on('alternatives')->onDelete('cascade');

            // Memberikan nama yang lebih pendek untuk unique constraint
            $table->unique(['criteria_id', 'alternative_id_1', 'alternative_id_2'], 'alt_comp_unique');
        });

        // Tabel Hasil
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alternative_id');
            $table->float('score');
            $table->timestamps();

            // Foreign key untuk alternative_id
            $table->foreign('alternative_id')->references('id')->on('alternatives')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Menghapus tabel dengan urutan yang benar
        Schema::dropIfExists('results');
        Schema::dropIfExists('alternative_comparisons');
        Schema::dropIfExists('criteria_comparisons');
        Schema::dropIfExists('alternatives');
        Schema::dropIfExists('criteria');
    }
}

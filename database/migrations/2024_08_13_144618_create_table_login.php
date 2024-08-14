<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogin  extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('nama', 255);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};

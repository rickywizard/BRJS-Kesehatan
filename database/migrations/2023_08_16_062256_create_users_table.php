<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->unsignedBigInteger('id_kota');
            $table->foreign('id_kota')->references('id_kota')->on('cities');
            $table->string('nomor_induk', 16);
            $table->string('nama', 100);
            $table->string('password', 255);
            $table->string('foto_profil', 255);
            $table->date('tanggal_lahir');
            $table->enum('gender', ['male', 'female']);
            $table->enum('gol_darah', ['AB', 'A', 'B', 'O']);
            $table->enum('kelas', ['1', '2', '3']);
            $table->enum('role', ['nasabah', 'admin']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

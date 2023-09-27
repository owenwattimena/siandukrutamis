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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['pengajuan', 'pembaruan']);
            $table->string('nik',16)->unique();
            $table->string('nama_kepala_keluarga');
            $table->integer('jumlah_anggota_keluarga');
            $table->string('pekerjaan');
            $table->integer('gaji');
            $table->string('email')->unique();
            $table->mediumText('alamat');
            $table->double('latitude');
            $table->double('longitude');
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
        Schema::dropIfExists('pengajuan');
    }
};

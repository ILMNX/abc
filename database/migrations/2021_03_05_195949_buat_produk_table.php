<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuatProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->integer('id_kategori');
            $table->string('nama_produk')->unique();
            $table->string('merk')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->integer('harga_dasar');
            $table->integer('harga_beli');
            $table->integer('le_commission');
            $table->integer('abc_operation');
            $table->integer('leadership_fund');
            $table->integer('harga_laporan');
            $table->integer('harga_tithe');
            $table->integer('harga_le');
            $table->integer('harga_umum');
            $table->integer('point_buku');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('harga_jual');
            $table->integer('stok');
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
        Schema::dropIfExists('produk');
    }
}

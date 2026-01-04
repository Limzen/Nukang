<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanprogressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laporanprogress', function (Blueprint $table) {
            $table->increments('id_progress'); // Primary Key
            $table->integer('id_tukang'); // Foreign Key ke tabel tukang
            $table->integer('id_pemesanan'); // Foreign Key ke tabel pemesanan
            $table->dateTime('tanggal_progress');
            $table->text('informasi_pekerjaan');
            $table->string('fotoprogress1', 50)->nullable();
            $table->string('fotoprogress2', 50)->nullable();
            $table->string('fotoprogress3', 50)->nullable();
            $table->string('fotoprogress4', 50)->nullable();
            $table->string('fotoprogress5', 50)->nullable();
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
		Schema::drop('laporanprogress');
	}

}

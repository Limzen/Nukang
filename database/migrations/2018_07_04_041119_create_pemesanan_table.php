<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemesanan', function(Blueprint $table)
		{
			$table->increments('id_pemesanan');
			$table->integer('id_tukang');
			$table->integer('id_pelanggan');
			$table->integer('id_jenispemesanan');
			$table->integer('id_kategoripemesanan');
			$table->string('nomorpemesanan',10);
			$table->string('biayajasa',30);
			$table->date('tanggalbekerja');
			$table->date('tanggalselesai');
			$table->text('catatan');
			$table->string('kategoripemesanan',1);
			$table->string('fotopemesanan1',50);
			$table->string('fotopemesanan2',50);
			$table->text('alamatpemesanan');
			$table->text('latitudepemesanan');
			$table->text('longtitudepemesanan');
			$table->text('alasanpenolakanpemesanan');
			$table->string('statuspemesanan',1);
			$table->string('statusubahharga',1);
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
		Schema::drop('pemesanan');
	}

}

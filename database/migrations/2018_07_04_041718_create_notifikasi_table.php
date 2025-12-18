<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifikasi', function(Blueprint $table)
		{
			$table->increments('id_notifikasi');
			$table->integer('dari');
			$table->integer('kepada');
			$table->text('isinotifikasi');
			$table->string('jenisnotifikasi',50);
			$table->string('statusnotifikasi',1);
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
		Schema::drop('notifikasi');
	}

}

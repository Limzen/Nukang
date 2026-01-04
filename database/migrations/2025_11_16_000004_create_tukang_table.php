<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTukangTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tukang', function (Blueprint $table) {
			$table->increments('id_tukang');
			$table->integer('id');
			$table->integer('id_kategoritukang');
			$table->string('namatukang', 255);
			$table->text('pengalamanbekerja');
			$table->string('lamapengalamanbekerja', 2);
			$table->text('deskripsikeahlian');
			$table->double('rating');
			$table->integer('totalvote');
			$table->integer('jumlahvote');
			$table->string('fotoktp', 50);
			$table->string('fotosim', 50);
			$table->string('statusjasakeahlian', 1);
			$table->string('statuseditprofil', 1);
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
		Schema::drop('tukang');
	}

}

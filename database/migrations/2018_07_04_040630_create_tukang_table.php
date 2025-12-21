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
			$table->text('pengalamanbekerja')->nullable();
			$table->string('lamapengalamanbekerja', 2);
			$table->text('deskripsikeahlian')->nullable();
			$table->double('rating')->default(0);
			$table->integer('totalvote')->default(0);
			$table->integer('jumlahvote')->default(0);
			$table->string('fotoktp', 50);
			$table->string('fotosim', 50);
			$table->string('fotohasilkerja', 50)->default('');
			$table->string('statusjasakeahlian', 1)->default('0');
			$table->string('statuseditprofil', 1)->default('0');
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

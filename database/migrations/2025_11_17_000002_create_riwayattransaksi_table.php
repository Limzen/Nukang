<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayattransaksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riwayattransaksi', function(Blueprint $table)
		{
			$table->increments('id_riwayattransaksi');
			$table->integer('id');
			$table->string('kode',10);
			$table->string('jumlahsaldo',30);
			$table->string('rekening',20);
			$table->string('namarekening',50);
			$table->string('rekeningtujuan',70);
			$table->text('jenistransaksi');
			$table->string('buktitransaksi',50);
			$table->string('statustransaksi',1);
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
		Schema::drop('riwayattransaksi');
	}

}

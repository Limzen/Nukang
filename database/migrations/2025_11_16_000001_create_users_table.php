<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('kodeuser', 20);
			$table->text('alamat');
			$table->string('nomorhandphone', 15);
			$table->string('saldo', 30);
			$table->string('nomorrekening', 20);
			$table->string('namarekening', 50);
			$table->string('fotoprofil', 50);
			$table->string('latitude', 30);
			$table->string('longtitude', 30);
			$table->string('statuspengguna', 1);
			$table->string('statusverifikasi', 1);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}

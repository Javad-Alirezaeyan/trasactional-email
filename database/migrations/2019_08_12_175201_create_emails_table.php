<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emails', function(Blueprint $table)
		{
			$table->bigInteger('email_id', true)->unsigned();
			$table->string('email_subject', 300);
			$table->text('email_contentValue', 65535);
			$table->string('email_to', 2000);
			$table->string('email_from', 100);
			$table->string('email_replyto', 100)->nullable();
			$table->string('email_contentType', 30)->nullable()->default('text/html');
			$table->smallInteger('email_state')->nullable()->default(0);
			$table->smallInteger('email_service')->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->text('email_orginalContent', 65535)->nullable();
			$table->boolean('email_deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emails');
	}

}

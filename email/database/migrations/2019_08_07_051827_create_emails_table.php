<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('email_id');
            $table->string('email_subject', 300);
            $table->text('email_contentValue');
            $table->json('email_to', 2000);
            $table->string('email_from', 100);
            $table->string('email_replyto', 100);
            $table->string('email_contentType',30);
            $table->smallInteger("email_state");
            $table->smallInteger('email_service');
            $table->softDeletes();
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
        Schema::dropIfExists('emails');
    }
}

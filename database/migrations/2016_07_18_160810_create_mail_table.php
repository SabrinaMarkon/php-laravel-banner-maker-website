<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // All site emails.
        Schema::create('mail', function(Blueprint $table) {
            $table->increments('id');
            $table->string('userid', 255)->nullable();
            $table->string('subject', 255);
            $table->longText('message');
            $table->string('url', 255);
            $table->dateTime('approved')->nullable();
            $table->char('needtosend', 1)->default(0);
            $table->dateTime('sent')->nullable();
            $table->integer('clicks');
            $table->char('save', 1)->default(0);
            $table->foreign('userid')->references('userid')->on('members');
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
        Schema::drop('mail');
    }
}


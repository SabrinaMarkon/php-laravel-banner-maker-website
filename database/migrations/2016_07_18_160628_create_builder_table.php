<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuilderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Member favorite sites they want to add to their downline builder and that of their referrals.
        Schema::create('builder', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid', 255);
            $table->string('name', 255);
            $table->text('desc');
            $table->string('url', 255);
            $table->char('bold', 1)->default(0);
            $table->string('color', 255);
            $table->integer('positionnumber')->default(0);
            $table->integer('category');
            $table->foreign('category')->references('id')->on('builder_cat');
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
        Schema::drop('builder');
    }
}

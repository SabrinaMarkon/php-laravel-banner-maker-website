<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuilderSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Admin programs to add to the downline builder system
        Schema::create('builder_sites', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('desc');
            $table->string('url', 255);
            $table->integer('order');
            $table->integer('category');
            $table->foreign('category')->references('id')->on('builder_cat');
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
        Schema::drop('builder_sites');
    }
}


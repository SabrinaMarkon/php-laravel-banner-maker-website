<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid', 255);
            $table->string('filename', 255)->unique();
            $table->longText('htmlcode');
            $table->integer('width')->default(1000);
            $table->integer('height')->default(300);
            $table->string('bgcolor', 255)->default('transparent');
            $table->string('bgimage', 255)->default('none');
            $table->string('bordercolor', 255)->default('transparent');
            $table->integer('borderwidth')->default(0);
            $table->string('borderstyle', 12)->default('solid');
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
        Schema::drop('banners');
    }
}

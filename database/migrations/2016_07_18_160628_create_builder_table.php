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
            $table->string('userid', 255);
            $table->string('fav1_title', 255);
            $table->string('fav1_desc', 255);
            $table->string('fav1_url', 255);
            $table->char('fav1_bold', 1)->default(0);
            $table->string('fav1_color', 255);
            $table->string('fav2_title', 255);
            $table->string('fav2_desc', 255);
            $table->string('fav2_url', 255);
            $table->char('fav2_bold', 1)->default(0);
            $table->string('fav2_color', 255);
            $table->string('fav3_title', 255);
            $table->string('fav3_desc', 255);
            $table->string('fav3_url', 255);
            $table->char('fav3_bold', 1)->default(0);
            $table->string('fav3_color', 255);
            $table->primary('userid');
            $table->foreign('userid')->references('userid')->on('members');
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

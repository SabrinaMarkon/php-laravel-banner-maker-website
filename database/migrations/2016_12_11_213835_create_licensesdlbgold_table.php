<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesdlbgoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licensesdlbgold', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid', 255);
            $table->dateTime('licensepaiddate')->nullable();
            $table->dateTime('licensestartdate');
            $table->dateTime('licenseenddate')->nullable(); // if one time payment only, this field will be null.
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
        Schema::drop('licensesdlbgold');
    }
}

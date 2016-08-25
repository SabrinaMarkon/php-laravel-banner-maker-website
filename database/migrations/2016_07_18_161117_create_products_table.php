<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Products the admin sells on the site. For example, the white label license.
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->longText('description');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 9, 2);
            $table->decimal('commission', 9, 2);
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
        Schema::drop('products');
    }
}


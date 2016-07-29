<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Content that the admin can add to display on pages automatically.
        Schema::create('pages', function(Blueprint $table){
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->longText('htmlcode');
            $table->timestamps();
        });

        DB::table('pages')->insert(array(
            array('name' => 'Home Page'),
            array('name' => 'About Us Page'),
            array('name' => 'Account Profile Page'),
            array('name' => 'Main Banner Page - Not Logged In'),
            array('name' => 'Main Banner Page - Logged In'),
            array('name' => 'Create  Banner Page'),
            array('name' => 'Existing Banners Page'),
            array('name' => 'Edit Banner Page'),
            array('name' => 'Downline Builder Page'),
            array('name' => 'FAQs Page'),
            array('name' => 'Forgot Password Page'),
            array('name' => 'Member Registration Page'),
            array('name' => 'License Sales Page'),
            array('name' => 'Login Page'),
            array('name' => 'Downline Mailer Page'),
            array('name' => 'Privacy Page'),
            array('name' => 'Support Page'),
            array('name' => 'Terms Page'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}

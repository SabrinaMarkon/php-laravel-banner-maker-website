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
            $table->string('slug', 255)->unique();
            $table->boolean('core')->default(true);
            $table->longText('htmlcode');
            $table->timestamps();
        });

        DB::table('pages')->insert(array(
            array('name' => 'Home Page', 'slug' => 'home'),
            array('name' => 'About Us Page', 'slug' => 'about'),
            array('name' => 'Account Profile Page', 'slug' => 'profile'),
            array('name' => 'Main Banner Page - Not Logged In', 'slug' => 'banners'),
            array('name' => 'Main Banner Page - Logged In', 'slug' => 'banners/main'),
            array('name' => 'Create Banner Page', 'slug' => 'banners/create'),
            array('name' => 'Existing Banners Page', 'slug' => 'banners/index'),
            array('name' => 'Edit Banner Page', 'slug' => 'banners/edit'),
            array('name' => 'Downline Builder Page', 'slug' => 'dlb'),
            array('name' => 'FAQs Page', 'slug' => 'faqs'),
            array('name' => 'Forgot Password Page', 'slug' => 'forgot'),
            array('name' => 'Member Registration Page', 'slug' => 'register'),
            array('name' => 'License Sales Page', 'slug' => 'license'),
            array('name' => 'Login Page', 'slug' => 'login'),
            array('name' => 'Downline Mailer Page', 'slug' => 'maildownline'),
            array('name' => 'Privacy Page', 'slug' => 'privacy'),
            array('name' => 'Support Page', 'slug' => 'support'),
            array('name' => 'Terms Page', 'slug' => 'terms'),
            array('name' => 'Products Sales Page', 'slug' => 'products'),
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

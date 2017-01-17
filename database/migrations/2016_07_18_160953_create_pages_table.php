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
            array('name' => 'Banner Page', 'slug' => 'banners'),
            array('name' => 'Downline Builder Page', 'slug' => 'dlb'),
            array('name' => 'FAQs Page', 'slug' => 'faqs'),
            array('name' => 'Forgot Password Page', 'slug' => 'forgot'),
            array('name' => 'Member Registration Page', 'slug' => 'join'),
            array('name' => 'License Sales Page', 'slug' => 'license'),
            array('name' => 'Login Page', 'slug' => 'login'),
            array('name' => 'Downline Mailer Page', 'slug' => 'maildownline'),
            array('name' => 'Privacy Page', 'slug' => 'privacy'),
            array('name' => 'Support Page', 'slug' => 'support'),
            array('name' => 'Terms Page', 'slug' => 'terms'),
            array('name' => 'Products Sales Page', 'slug' => 'products'),
            array('name' => 'Account Main Page', 'slug' => 'account'),
            array('name' => 'Promote Page', 'slug' => 'promote'),
            array('name' => 'Successful Signup Page', 'slug' => 'success'),
            array('name' => 'Successful Verification Page', 'slug' => 'verify'),
            array('name' => 'Successfully Deleted Account Page', 'slug' => 'delete'),
            array('name' => 'Successful Purchase Page', 'slug' => 'thankyou'),
            array('name' => 'Splash Page', 'slug' => 'splash'),
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

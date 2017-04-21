<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Site settings.
        Schema::create('settings', function(Blueprint $table) {
            $table->string('name', 255);
            $table->string('setting', 255);
            $table->string('description', 400);
            $table->primary('name');
            $table->timestamps();
        });

        // Populate with initial settings.

        DB::table('settings')->insert(array(
            array('name'    =>    'adminname',
            'setting'    =>    'Your Name',
            'description'    =>    'Admin Name'),
            array('name'    =>    'domain',
                'setting'    =>    'http://bannermaker.phpsitescripts.com',
                'description'    =>    'Website Main Domain URL (with http:// and NO trailing slash)'),
            array('name'    =>    'sitename',
                'setting'    =>    "Your Site Name",
                'description'    =>    'Website Name'),
            array('name'    =>    'adminemail',
                'setting'    =>    'phpsitescripts@outlook.com',
                'description'    =>    'Admin Support Email'),
            array('name'    =>    'adminpaypal',
                'setting'    =>    'payments@pearlsofwealth.com',
                'description'    =>    'Admin Paypal Account'),
            array('name'    =>    'adminpayza',
                'setting'    =>    'payments@pearlsofwealth.com',
                'description'    =>    'Admin Payza Account'),
            array('name'    =>    'downlinemailhowoften',
                'setting'    =>    '24',
                'description'    =>    'Hours Between Mailing Downline'),
            array('name'    =>    'licensepricelifetime',
                'setting'    =>    '119.99',
                'description'    =>    'Lifetime License Price to Remove Banner Watermark'),
            array('name'    =>    'licensepricemonthly',
                'setting'    =>    '9.99',
                'description'    =>    'Monthly License Price to Remove Banner Watermark'),
            array('name'    =>    'licensepriceannually',
                'setting'    =>    '99.99',
                'description'    =>    'Annual License Price to Remove Banner Watermark'),
            array('name'    =>    'licensecommissionlifetime',
                'setting'    =>    '0.00',
                'description'    =>  'Commission for Referral Purchasing Lifetime Banner License'),
            array('name'    =>    'licensecommissionmonthly',
                'setting'    =>    '0.00',
                'description'    =>  'Commission for Referral Purchasing Monthly Banner License'),
            array('name'    =>    'licensecommissionannually',
                'setting'    =>    '0.00',
                'description'    =>  'Commission for Referral Purchasing Annual Banner License'),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}

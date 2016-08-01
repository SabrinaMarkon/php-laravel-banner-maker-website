<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


////////////////////////// MAIN //////////////////////

Route::get('/', 'PagesController@home');

Route::get('about', 'PagesController@about');

Route::get('banners', 'PagesController@banners');

Route::get('dlb', 'PagesController@dlb');

Route::get('license', 'PagesController@license');

Route::get('terms', 'PagesController@terms');

Route::get('privacy', 'PagesController@privacy');

Route::get('faqs', 'PagesController@faqs');

Route::get('support', 'PagesController@support');

Route::get('join', 'PagesController@join');

Route::get('login', 'PagesController@login');

Route::get('forgot', 'PagesController@forgot');

Route::get('account', 'PagesController@account');

Route::get('logout', 'PagesController@home');


////////////////////////// MEMBERS //////////////////////




////////////////////////// ADMIN //////////////////////
    /*
     * Admin login page
     */
    Route::match(['get', 'post'], 'admin', array('uses' => 'Admin\AdminLoginController@home'));

    /*
     * Admin forgot login
     */
    Route::get('admin/forgot', 'Admin\AdminLoginController@forgot');

    /*
    Routes for Authenticated Admin Area
    */
    // Route::group(array('middleware' => 'admin'), function() {
    //Route::group(array('middleware' => 'auth'), function() {

    /*
     *  Main Admin Area
     */
    Route::get('admin/main', array('uses' => 'Admin\MainAdminController@index'));
   /*
    *  Members
    */
      Route::resource('admin/members', 'Admin\MembersController');
    /*
     *  Downline Builder
     */
       Route::resource('admin/dlb', 'Admin\BuildersController');
    /*
     *  FAQ
     */
       Route::resource('admin/faqs', 'Admin\FaqsController');
    /*
     *  Mail
     */
       Route::resource('admin/mailout', 'Admin\MailsController');
    /*
     *  Settings
     */
        Route::resource('admin/settings', 'Admin\SettingsController');
    /*
     *  Banners
     */
        Route::resource('admin/banners', 'Admin\BannersController');
    /*
     *  Edit Pages
     */
        Route::resource('admin/content', 'Admin\ContentController');
    /*
     *  Products
     */
        Route::resource('admin/products', 'Admin\ProductsController');
    /*
     *  Transactions
     */
        Route::resource('admin/transactions', 'Admin\TransactionsController');
        /*
         *  Promotional
         */
        Route::resource('admin/promotionals', 'Admin\PromotionalsController');
    /*
     *  Logout
     */
    Route::get('admin/logout', 'Admin\AdminLoginController@home');

//});

Route::auth();

Route::get('/home', 'HomeController@index');

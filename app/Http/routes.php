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
Route::group(array('middleware' => 'auth'), function() {

    // make sure button links are good.
    /*
    Route::get('admin', array('as' => 'admin', function() {
        // naming the view with as allows us to use {{ URL::route('admin') }} to create links in the admin area.
        return View::make('pages.admin.main');
    }));
    */

    /*
 *  Main Admin Area
 */
    Route::get('admin/main', array('uses' => 'Admin\MainAdminController@index'));

    /*
  *  Members
  */
    Route::get('admin/members', array('uses' => 'Admin\MembersController@index'));

    /*
     *  Downline Builder
     */
    Route::get('admin/dlb', array('uses' => 'Admin\BuildersController@index'));

    /*
     *  FAQ
     */
//Route::get('admin/faqs', 'FaqsController@index');
    Route::get('admin/faqs', array('uses' => 'Admin\FaqsController@index'));

    /*
     *  Mail
     */
    Route::get('admin/mailout', array('uses' => 'Admin\MailsController@index'));

    /*
     *  Settings
     */
    Route::get('admin/settings', array('uses' => 'Admin\SettingsController@index'));

    /*
     *  Banners
     */
    Route::get('admin/banners', array('uses' => 'Admin\BannersController@index'));

    /*
     *  Edit Pages
     */
    Route::get('admin/content', array('uses' => 'Admin\ContentController@index'));

    /*
     *  Products
     */
    Route::get('admin/products', array('uses' => 'Admin\ProductsController@index'));

    /*
     *  Transactions
     */
    Route::get('admin/transactions', array('uses' => 'Admin\TransactionsControllers@index'));

    /*
     *  Promotional
     */
    Route::get('admin/promotionals', array('uses' => 'Admin\PromotionalsController@index'));

    /*
     *  Logout
     */
    Route::get('admin/logout', 'Admin\AdminLoginController@home');

});

Route::auth();

Route::get('/home', 'HomeController@index');

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

/*
 *  Basic reading
 */
Route::get('/', 'PagesController@home');

Route::get('about', 'PagesController@about');

Route::get('terms', 'PagesController@terms');

Route::get('privacy', 'PagesController@privacy');

Route::get('support', 'PagesController@support');

Route::get('logout', 'PagesController@home');


/*
 *  Basic reading and display of database data
 */
Route::get('faqs', 'PagesController@faqs');

Route::get('promote', 'PagesController@promote');

/*
 *  Complex database functionality
 */
Route::get('banners', 'PagesController@banners');

Route::get('license', 'PagesController@license');

Route::get('products', 'PagesController@products');

Route::get('join', 'PagesController@join');

Route::get('login', 'PagesController@login');

Route::get('forgot', 'PagesController@forgot');

Route::get('account', 'PagesController@account');

Route::resource('profile', 'MembersController');

Route::resource('maildownline', 'MailsController');

Route::resource('dlb', 'BuildersController');

////////////////////////// MEMBERS //////////////////////




////////////////////////// ADMIN //////////////////////
/*
 * Admin login page
 */
//Route::match(['get', 'post'], 'admin', array('uses' => 'Admin\AdminLoginController@home'));
Route::get('admin', 'Admin\AdminLoginController@index');

/*
 * Admin forgot login
 */
Route::get('admin/forgot', 'Admin\AdminLoginController@forgot');

/*
* Admin Logout
*/
Route::get('admin/logout', 'Admin\AdminLoginController@logout');

/*
Routes for Authenticated Admin Area
// IMPORTANT: The middleware name ('admin') has to match the name specified in the Kernel.php file!
*/
#Route::group(array('middleware' => ['auth', 'admin']), function() {

/*
 *  Main Admin Area
 */
    Route::post('admin', 'Admin\AdminLoginController@main');
    Route::get('admin/main', array('uses' => 'Admin\MainAdminController@index'));
/*
Route::get('admin/main', ['middleware' => ['auth', 'admin'], function() {
    return "this page requires that you be logged in and an Admin";
}]);
*/
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
*  LIcenses
*/
    Route::resource('admin/licenses', 'Admin\LicensesController');
/*
 *  Transactions
 */
    Route::resource('admin/transactions', 'Admin\TransactionsController');
/*
*  Promotional
*/
    Route::resource('admin/promotionals', 'Admin\PromotionalsController');

#});

Route::auth();

Route::get('/home', 'HomeController@index');

/*
 * Custom pages added by the admin
 * IMPORTANT: this must be the last route or core pages such as faqs will
 * be treated as a custom page instead of a core. This causes them to show the
 * admin's text they add but not any database data.
 */
Route::get('{page}', 'PagesController@custompage');


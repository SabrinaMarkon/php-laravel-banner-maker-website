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

Route::get('about/{referid}', 'PagesController@about');
Route::get('about', 'PagesController@about');

Route::get('terms/{referid}', 'PagesController@terms');
Route::get('terms', 'PagesController@terms');

Route::get('privacy/{referid}', 'PagesController@privacy');
Route::get('privacy', 'PagesController@privacy');

Route::get('support/{referid}', 'PagesController@support');
Route::get('support', 'PagesController@support');

Route::get('thankyou', 'PagesController@thankyou'); // return url after user makes a purchase.

Route::get('logout', 'PagesController@logout');

Route::get('delete', 'PagesController@delete');

/*
 *  Basic reading and display of database data
 */
Route::get('faqs/{referid}', 'PagesController@faqs');
Route::get('faqs', 'PagesController@faqs');

/*
 *  Complex database functionality
 */
Route::get('join/{referid}', 'PagesController@join');
Route::get('join', 'PagesController@join');
Route::post('join', 'PagesController@joinpost');

Route::get('success', 'PagesController@success');

Route::get('verify/{code}', 'PagesController@verify');
Route::get('verify', 'PagesController@verify');

Route::get('login/{referid}', 'PagesController@login');
Route::get('login', 'PagesController@login');
Route::post('login', 'PagesController@loginpost');

Route::get('forgot/{referid}', 'PagesController@forgot');
Route::get('forgot', 'PagesController@forgot');
Route::post('forgot', 'PagesController@emaillogin');

Route::get('reset/{code}', 'PagesController@reset');
Route::get('reset', 'PagesController@reset');
Route::post('reset', 'PagesController@resetpost');

Route::get('ipn', 'IPNsController@ipn'); // IPN url for license purchases.

////////////////////////// MEMBERS //////////////////////

// IMPORTANT: The middleware name ('memberauth') has to match the name specified in the Kernel.php file!
Route::group(array('middleware' => ['memberauth']), function() {

    Route::get('account', 'PagesController@account');

    Route::get('promote', 'PagesController@promote');

    Route::get('license', 'LicensesController@index');

    Route::resource('banners', 'BannersController');
    Route::post('banners/getbanner', 'BannersController@getbanner'); // make and save the banner file. Save html to the database to edit later if desired.
    Route::post('banners/filetree/{folder}', 'BannersController@fileTree'); // get image files for the selected folder.
    Route::post('banners/licensecheck/{userid}', 'BannersController@licenseCheck');  // check if the userid has a valid license to decide whether to watermark images or not.

    Route::resource('profile', 'MembersController');
//    Route::post('delete', 'MembersController@destroy');

    Route::resource('maildownline', 'MailsController');

    Route::resource('dlb', 'BuildersController');

    Route::get('products', 'PagesController@products');
});

////////////////////////// ADMIN //////////////////////
/*
 * Admin login page
 */
Route::get('admin', 'Admin\AdminLoginController@index');
Route::post('admin', 'Admin\AdminLoginController@loginpost');

/*
 * Admin forgot login
 */
Route::get('admin/forgot', 'Admin\AdminLoginController@forgot');
Route::post('admin/forgot', 'Admin\AdminLoginController@emaillogin');
Route::get('admin/reset/{code}', 'Admin\AdminLoginController@reset');
Route::get('admin/reset', 'Admin\AdminLoginController@reset');
Route::post('admin/reset', 'Admin\AdminLoginController@resetpost');

/*
* Admin Logout
*/
Route::get('admin/logout', 'Admin\AdminLoginController@logout');

/*
Routes for Authenticated Admin Area
// IMPORTANT: The middleware name ('adminauth') has to match the name specified in the Kernel.php file!
*/
Route::group(array('middleware' => ['adminauth']), function() {

/*
 *  Main Admin Area
 */
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

});

//Route::auth();

Route::get('/home', 'HomeController@index');

/*
 * ORDER BELOW IS IMPORTANT!
 */

/*
 * Custom pages added by the admin
 * IMPORTANT: this must be the last route or core pages such as faqs will
 * be treated as a custom page instead of a core. This causes them to show the
 * admin's text they add but not any database data.
 */
Route::get('{page}/{referid}', 'PagesController@custompage');

/*
 * home page with optional referid. These are the last routes so they aren't used when the route is say,
 * /about (where the 'about' would be misinterpreted as the referid).
 */
Route::get('/{referid}', 'PagesController@home');
Route::get('/', 'PagesController@home');



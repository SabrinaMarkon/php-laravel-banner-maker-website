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

/*
 Routes for Admin
 */

Route::group(array('prefix' => 'admin'), function()
{
    Route::get('/', function()
    {
        return View::make('pages.admin.index');
    });
    Route::get('index', function()
    {
        return View::make('pages.admin.index');
    });
    Route::get('settings', function() {
        return View::make('pages.admin.settings');
    });
    Route::get('content', function() {
        return View::make('pages.admin.content');
    });
    Route::get('dlb', function() {
        return View::make('pages.admin.dlb');
    });
    Route::get('faqs', function() {
        return View::make('pages.admin.faqs');
    });
    Route::get('products', function() {
        return View::make('pages.admin.products');
    });
    Route::get('banners', function() {
        return View::make('pages.admin.banners');
    });
    Route::get('members', function() {
        return View::make('pages.admin.members');
    });
    Route::get('mailout', function() {
        return View::make('pages.admin.mailout');
    });
});


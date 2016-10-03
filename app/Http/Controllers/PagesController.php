<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Faq;
use App\Models\Member;
use App\Models\Page;
use App\Models\Product;
use App\Models\Promotional;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use View;

class PagesController extends Controller
{

    public function index($referid = null) {
        $content = Page::where('slug', '=', 'home')->first();
        Session::flash('page', $content);
        return view('pages.index', compact('referid'));
    }

    public function home($referid = null) {
        $content = Page::where('slug', '=', 'home')->first();
        Session::flash('page', $content);
        return view('pages.home', compact('referid'));
    }

    public function about($referid = null) {
        $content = Page::where('slug', '=', 'about')->first();
        Session::flash('page', $content);
        return view('pages.about', compact('referid'));
    }

    public function terms($referid = null) {
        $content = Page::where('slug', '=', 'terms')->first();
        Session::flash('page', $content);
        return view('pages.terms', compact('referid'));
    }

    public function privacy($referid = null) {
        $content = Page::where('slug', '=', 'privacy')->first();
        Session::flash('page', $content);
        return view('pages.privacy', compact('referid'));
    }

    public function support($referid = null) {
        $content = Page::where('slug', '=', 'support')->first();
        Session::flash('page', $content);
        return view('pages.support', compact('referid'));
    }

    public function faqs($referid = null) {
        // get the admin's content for the FAQ page if they've written any.
        $page = Page::where('slug', '=', 'faqs')->first();
        // get the questions and answers.
        $faqs = Faq::orderBy('positionnumber', 'asc')->get();
        return view('pages.faqs', compact('faqs', 'page', 'referid'));
    }

    public function banners($referid = null) {
        return view('pages.banners', compact('referid'));
    }

    public function license($referid = null) {
        // get the admin's content for the license sales page if they've written any.
        $page = Page::where('slug', '=', 'license')->first();
        return view('pages.license', compact('page', 'referid'));
    }

    public function products($referid = null) {
        // get the admin's content for the product sales page if they've written any.
        $page = Page::where('slug', '=', 'products')->first();
        // get the products.
        $products = Product::all();
        return view('pages.products', compact('products', 'page', 'referid'));
    }

    public function join($referid = null) {
        return view('pages.join', compact('referid'));
    }

    public function login($referid = null) {
        return view('pages.login', compact('referid'));
    }

    public function forgot($referid = null) {
        return view('pages.forgot', compact('referid'));
    }

    public function emaillogin(Request $request, $referid = null) {

        $forgotemail = $request->get('forgotemail');
        $found = Member::where('email', $forgotemail)->first();
        if ($found !== null) {
            // CODE TO EMAIL LOGIN?!?!
            Session::flash('message', ' Check your email, ' . $found->email . ', for a link to reset your password!');
        } else {
            Session::flash('errors', 'That email address was not found');
        }
        return Redirect::to('forgot');

    }

    public function account($referid = null) {
        $content = Page::where('slug', '=', 'account')->first();
        Session::flash('page', $content);
        return view('pages.account', compact('referid'));
    }

    public function promote($referid = null) {
        // get the admin's content for the FAQ page if they've written any.
        $page = Page::where('slug', '=', 'promote')->first();
        // get the questions and answers.
        $promotes = Promotional::orderBy('type')->get();
        return view('pages.promote', compact('promotes', 'page', 'referid'));
    }

    public function custompage($page, $referid = null) {
        $content = Page::where('slug', '=', $page)->first();
        Session::flash('page', $content);
        return view('pages.custompage', compact('referid'));
    }

}

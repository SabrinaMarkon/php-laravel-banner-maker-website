<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Page;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Promotional;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use View;

class PagesController extends Controller
{

    public function index() {
        $content = Page::where('slug', '=', 'home')->first();
        Session::flash('page', $content);
        return view('pages.index');
    }

    public function home() {
        $content = Page::where('slug', '=', 'home')->first();
        Session::flash('page', $content);
        return view('pages.home');
    }

    public function about() {
        $content = Page::where('slug', '=', 'about')->first();
        Session::flash('page', $content);
        return view('pages.about');
    }

    public function terms() {
        $content = Page::where('slug', '=', 'terms')->first();
        Session::flash('page', $content);
        return view('pages.terms');
    }

    public function privacy() {
        $content = Page::where('slug', '=', 'privacy')->first();
        Session::flash('page', $content);
        return view('pages.privacy');
    }

    public function support() {
        $content = Page::where('slug', '=', 'support')->first();
        Session::flash('page', $content);
        return view('pages.support');
    }

    public function faqs() {
        // get the admin's content for the FAQ page if they've written any.
        $page = Page::where('slug', '=', 'faqs')->first();
        // get the questions and answers.
        $faqs = Faq::orderBy('positionnumber', 'asc')->get();
        return view('pages.faqs', compact('faqs', 'page'));
    }

    public function banners() {
        return view('pages.banners');
    }

    public function license() {
        return view('pages.license');
    }

    public function products() {
        // get the admin's content for the product sales page if they've written any.
        $page = Page::where('slug', '=', 'products')->first();
        // get the questions and answers.
        $products = Product::all();
        return view('pages.products', compact('products', 'page'));
    }

    public function join() {
        return view('pages.join');
    }

    public function login() {
        return view('pages.login');
    }

    public function forgot() {
        return view('pages.forgot');
    }

    public function account() {
        $content = Page::where('slug', '=', 'account')->first();
        Session::flash('page', $content);
        return view('pages.account');
    }

    public function profile() {
        $content = Page::where('slug', '=', 'profile')->first();
        Session::flash('page', $content);
        return view('pages.profile');
    }

    public function promote() {
        // get the admin's content for the FAQ page if they've written any.
        $page = Page::where('slug', '=', 'promote')->first();
        // get the questions and answers.
        $promotes = Promotional::orderBy('type')->get();
        return view('pages.promote', compact('promotes', 'page'));
    }

    public function custompage($page) {
        $content = Page::where('slug', '=', $page)->first();
        Session::flash('page', $content);
        return view("pages.custompage");
    }

}

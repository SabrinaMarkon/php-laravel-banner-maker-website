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
    public function setreferid($referid = null) {
        if ($referid !== null) {
            if (!Session::has('referid')) {
                Session::set('referid', $referid);
            }
        }
    }

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

    public function logout() {
        Session::set('user', null);
        $content = Page::where('slug', '=', 'home')->first();
        Session::flash('page', $content);
        return view('pages.home');
    }

    public function about($referid = null) {
        $this->setreferid($referid);
        $content = Page::where('slug', '=', 'about')->first();
        Session::flash('page', $content);
        return view('pages.about');
    }

    public function terms($referid = null) {
        $this->setreferid($referid);
        $content = Page::where('slug', '=', 'terms')->first();
        Session::flash('page', $content);
        return view('pages.terms');
    }

    public function privacy($referid = null) {
        $this->setreferid($referid);
        $content = Page::where('slug', '=', 'privacy')->first();
        Session::flash('page', $content);
        return view('pages.privacy');
    }

    public function support($referid = null) {
        $this->setreferid($referid);
        $content = Page::where('slug', '=', 'support')->first();
        Session::flash('page', $content);
        return view('pages.support');
    }

    public function faqs($referid = null) {
        $this->setreferid($referid);
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
        // get the admin's content for the license sales page if they've written any.
        $page = Page::where('slug', '=', 'license')->first();
        return view('pages.license', compact('page'));
    }

    public function products($referid = null) {
        $this->setreferid($referid);
        // get the admin's content for the product sales page if they've written any.
        $page = Page::where('slug', '=', 'products')->first();
        // get the products.
        $products = Product::all();
        return view('pages.products', compact('products', 'page'));
    }

    public function join($referid = null) {
        $this->setreferid($referid);
        return view('pages.join', compact('referid'));
    }

    public function login($referid = null) {
        $this->setreferid($referid);
        return view('pages.login', compact('referid'));
    }
    public function loginpost(Request $request, $referid = null) {
        $this->setreferid($referid);
        $user = Member::where('userid', '=', $request->get('userid'))->first();
        if ($user) {
            $passwordIsOk = password_verify( $request->get('password'), $user->password);
            if ($passwordIsOk) {
                Session::set('user', $user);
                return Redirect::to('account');
            } else {
                Session::set('user', null);
                Session::flash('message', 'Incorrect Login');
                return Redirect::to('login');
            }
        } else {
            Session::set('user', null);
            Session::flash('message', 'Incorrect Login');
            return Redirect::to('login');
        }
    }

    public function forgot($referid = null) {
        $this->setreferid($referid);
        return view('pages.forgot');
    }
    public function emaillogin(Request $request, $referid = null) {

        $this->setreferid($referid);
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

    public function account() {
        $content = Page::where('slug', '=', 'account')->first();
        Session::flash('page', $content);
        return view('pages.account');
    }

    public function promote() {

        // get the admin's content for the FAQ page if they've written any.
        $page = Page::where('slug', '=', 'promote')->first();
        // get the questions and answers.
        $promotes = Promotional::orderBy('type')->get();
        // get the member's referrals:
        $referrals = Member::where('referid', '=', Session::get('user')->userid)->get();
        return view('pages.promote', compact('promotes', 'page', 'referrals'));

    }

    public function custompage($page, $referid = null) {
        $this->setreferid($referid);
        $content = Page::where('slug', '=', $page)->first();
        Session::flash('page', $content);
        return view('pages.custompage');
    }

}

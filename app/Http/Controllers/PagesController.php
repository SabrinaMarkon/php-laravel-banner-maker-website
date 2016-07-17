<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function about() {
        return view('pages.about');
    }

    public function banners() {
        return view('pages.banners');
    }

    public function dlb() {
        return view('pages.dlb');
    }

    public function license() {
        return view('pages.license');
    }

    public function terms() {
        return view('pages.terms');
    }

    public function privacy() {
        return view('pages.privacy');
    }

    public function faqs() {
        return view('pages.faqs');
    }

    public function support() {
        return view('pages.support');
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
        return view('pages.account');
    }

    /*
     *  Admin pages
     */
    public function showadminpage($page) {
        return view("pages.admin." . $page);
    }

}

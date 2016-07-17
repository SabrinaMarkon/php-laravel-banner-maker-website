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
    public function adminindex() {
        return view('pages.admin.index');
    }

    public function adminsettings() {
        return view('pages.admin.settings');
    }

    public function admincontent() {
        return view('pages.admin.content');
    }

    public function admindlb() {
        return view('pages.admin.dlb');
    }

    public function adminfaqs() {
        return view('pages.admin.faqs');
    }

    public function adminproducts() {
        return view('pages.admin.products');
    }

    public function adminbanners() {
        return view('pages.admin.banners');
    }

    public function adminmembers() {
        return view('pages.admin.members');
    }

    public function adminmailout() {
        return view('pages.admin.mailout');
    }
    

}

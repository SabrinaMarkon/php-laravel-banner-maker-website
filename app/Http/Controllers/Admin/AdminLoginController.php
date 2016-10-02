<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Session;

class AdminLoginController extends Controller
{
    // show main admin area
    public function index() {
        return view('pages.admin.index');
    }
    public function main() {
        return view('pages.admin.main');
    }
    public function logout() {
        Session::flush();
        return Redirect::to('admin');
    }
    public function forgot() {
        return view('pages.admin.forgot');
    }
    public function emaillogin() {
        // CODE TO EMAIL LOGIN?!?!
        return view('pages.admin.forgot');
    }
}
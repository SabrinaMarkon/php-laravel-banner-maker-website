<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    // show main admin area
    public function index() {
        return view('pages.admin.main');
    }
    public function home() {
        return view('pages.admin.index');
    }
    public function forgot() {
        return view('pages.admin.forgot');
    }
    public function emaillogin() {
        // CODE TO EMAIL LOGIN?!?!
        return view('pages.admin.forgot');
    }
}
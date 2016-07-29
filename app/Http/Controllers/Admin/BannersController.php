<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    // list all banners
    public function index() {
        return view('pages.admin.banners');
    }
}

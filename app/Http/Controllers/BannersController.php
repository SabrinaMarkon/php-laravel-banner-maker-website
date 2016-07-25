<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BannersController extends Controller
{
    // list all banners
    public function index() {
        return view('pages.admin.banners');
    }
}

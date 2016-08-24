<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class PromotionalsController extends Controller
{
    // list all promotional materials
    public function index() {
        return view('pages.admin.promotionals');
    }
}

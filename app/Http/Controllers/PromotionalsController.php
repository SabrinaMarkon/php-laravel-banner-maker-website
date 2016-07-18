<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PromotionalsController extends Controller
{
    // list all promotional materials
    public function index() {
        return view('promotionals.index');
    }
}

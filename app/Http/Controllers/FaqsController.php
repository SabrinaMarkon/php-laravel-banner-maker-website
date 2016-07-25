<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FaqsController extends Controller
{
    // list all faqs
    public function index() {
        return view('pages.admin.faqs');
    }
}

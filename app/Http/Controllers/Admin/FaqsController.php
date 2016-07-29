<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class FaqsController extends Controller
{
    // list all faqs
    public function index() {
        return view('pages.admin.faqs');
    }
}

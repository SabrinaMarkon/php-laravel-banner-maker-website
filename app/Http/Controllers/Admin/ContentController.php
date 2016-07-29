<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    // content editing.
    public function index() {
        return view('pages.admin.content');
    }
}

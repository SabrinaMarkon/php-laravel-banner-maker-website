<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class BuildersController extends Controller
{
    // list all downline builders
    public function index() {
        return view('pages.admin.dlb');
    }
    
}

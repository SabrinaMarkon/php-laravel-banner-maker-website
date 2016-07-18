<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BuildersController extends Controller
{
    // list all downline builders
    public function index() {
        return view('builders.index');
    }
    
}

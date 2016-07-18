<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MembersController extends Controller
{
    public function index() {
        // list all members
        return view('members.index');

    }
}

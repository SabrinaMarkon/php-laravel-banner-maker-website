<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Member;

class MembersController extends Controller
{
    public function index() {
        // get all members
        $members = Member::all();

        return view('pages.admin.members', compact('members'));

    }
}

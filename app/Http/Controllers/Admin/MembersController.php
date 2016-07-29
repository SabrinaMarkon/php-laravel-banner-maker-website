<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Member;

use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function index() {
        // get all members
        $members = Member::all();

        return view('pages.admin.members', compact('members'));

    }
}

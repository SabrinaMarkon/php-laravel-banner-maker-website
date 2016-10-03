<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Redirect;
use Session;

class AdminLoginController extends Controller
{
    // show main admin area
    public function index() {
        return view('pages.admin.index');
    }
    public function main() {
        return view('pages.admin.main');
    }
    public function logout() {
        Session::flush();
        return Redirect::to('admin');
    }
    public function forgot() {
        return view('pages.admin.forgot');
    }

    public function emaillogin(Request $request) {

        $forgotemail = $request->get('forgotemail');
        $found = Member::where('email', $forgotemail)->first();
        if ($found !== null) {
            // CODE TO EMAIL LOGIN?!?!
            Session::flash('message', ' Check your email, ' . $found->email . ', for a link to reset your password!');
        } else {
            Session::flash('errors', 'That email address was not found');
        }
        return Redirect::to('admin/forgot');

    }


}
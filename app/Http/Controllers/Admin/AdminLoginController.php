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

    // main admin login
    public function main() {
        return view('pages.admin.main');
    }
    // admin login posted
    public function loginpost(Request $request) {

        $user = Member::where('userid', '=', $request->get('userid'))->where('admin', '=', 1)->first();
        if ($user) {
            $passwordIsOk = password_verify( $request->get('password'), $user->password);
            if ($passwordIsOk) {
                Session::set('user', $user);
                return Redirect::to('admin/main');
            } else {
                Session::set('user', null);
                Session::flash('message', 'Incorrect Login');
                return Redirect::to('admin');
            }
        } else {
            Session::set('user', null);
            Session::flash('message', 'Incorrect Login');
            return Redirect::to('admin');
        }
    }

    // admin logout
    public function logout() {
        Session::set('user', null);
        return Redirect::to('admin');
    }

    // admin forgot login
    public function forgot() {
        return view('pages.admin.forgot');
    }

    // email password reset to admin
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
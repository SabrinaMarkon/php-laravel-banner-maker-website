<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PasswordReset;
use Session;
use Redirect;
use Validator;
use DateTime;
use Mail;

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

            // forgotten password link email
            $passwordreset = new PasswordReset();
            $passwordreset->email = $forgotemail;
            $passwordreset->token = str_random(30);
            $passwordreset->save();

            // forgotten password link email:
            $html = "Dear ".$found->firstname.",<br><br>";
            $html .= "Please click here to reset your " . $request->get('sitename') . " admin password:<br>";
            $html .= "<a href=\"" . $request->get('domain') . "/admin/reset/" . $passwordreset->token . "\">" . $request->get('domain') . "/admin/reset/" . $passwordreset->token . "</a>";
            $html .=  "<br><br><br>";

            Mail::send(array(), array(), function ($message) use ($html, $request, $forgotemail, $found) {
                $message->to($forgotemail, $found->firstname . ' ' . $found->lastname)
                    ->subject($request->get('sitename') . ' Password Reset')
                    ->from($request->get('adminemail'), $request->get('adminname'))
                    ->setBody($html, 'text/html');
            });

            Session::flash('message', ' Check your email, ' . $found->email . ', for a link to reset your password!');
        } else {
            Session::flash('errors', 'That email address was not found');
        }
        return Redirect::to('admin/forgot');
    }

    // reset admin password code check and reset form.
    public function reset(Request $request, $code = null) {
        $resetpass = PasswordReset::where('token', '=', $code)->first();
        if ($resetpass) {
            $member = Member::where('email', '=', $resetpass->email)->first();
            if ($member) {
                return view('pages.admin.reset', compact('code'));
            } else {
                $message = 'Invalid Link';
                return view('pages.admin.reset', compact('code', 'message'));
            }
        } else {
            $message = 'Invalid Link';
            return view('pages.admin.reset', compact('code', 'message'));
        }
    }

    // reset admin password.
    public function resetpost(Request $request) {
        $code = $request->code;
        $rules = array(
            'password' => 'required|min:6|max:255|confirmed',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('pages.admin.reset', compact('code', 'errors'));
        } else {
            $resetpass = PasswordReset::where('token', '=', $code)->first();
            if ($resetpass) {
                $newpassword = bcrypt($request->get('password'));
                $member = Member::where('email', '=', $resetpass->email)->update(['password' => $newpassword]);
                Session::flash('message', 'resetsuccess');
                return Redirect::to('admin');
            } else {
                $message = 'Invalid Link';
                return view('pages.admin.reset', compact('code', 'message'));
            }
        }
    }



}
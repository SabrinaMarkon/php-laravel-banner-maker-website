<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Member;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;
use Mail;

class MembersController extends Controller
{

    /**
     * Show all members.
     *
     * @return Response
     */
    public function index()
    {

        $member = Member::where('userid', '=', 'sabrina')->first(); //fix.
        $content = Page::where('slug', '=', 'profile')->first();
        return view('pages.profile', compact('member', 'content'));

    }


    /**
     * Update member info.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {

        // form validation.
        $rules = array(
            'password' => 'present|min:6|max:255|confirmed',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:members,email,'.$id,
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('profile');
        } else {
            // update record.
            $member = Member::find($id);
            if ($request->get('password') != "") {
                $member->password = bcrypt($request->get('password'));
            }
            $member->firstname = $request->get('firstname');
            $member->lastname = $request->get('lastname');
            $oldemail = Member::where('email', '=', $request->get('email'))->first();
            if ($oldemail === null) {
                $member->email = $request->get('email');
                // email was changed so send validation email and reset to unverified.
                $member->verified = 0;
                $body = "I love Lucas";
                Mail::raw($body, function ($message) use ($request) {
                    $message->from('test@sadiesbannercreator.com', 'Lucas Markon');
                    $message->to($request->get('email'), $request->get('firstname') . ' ' . $request->get('lastname'))
                     ->subject('Email Verification');
                });

                Session::flash('message', 'Successfully updated your account!<br>You changed your email address, so will need to verify it before logging in again');
            } else {
                Session::flash('message', 'Successfully updated your account');
            }
            $member->save();
            return Redirect::to('profile');
        }

    }

    /**
     * Delete account.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {

        $member = Member::find($id);
        $userid = $member->userid;
        $member->delete();
        Session::flash('message', 'Your account was successfully deleted');
        return Redirect::to('delete');

    }

}
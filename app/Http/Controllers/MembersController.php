<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Builder;
use App\Models\License;
use App\Models\Mail;
use App\Models\Member;
use App\Models\Page;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;
use View;

class MembersController extends Controller
{
    /**
     * Show all members.
     *
     * @return Response
     */
    public function index()
    {

        $member = Member::where('userid', '=', Session::get('user')->userid)->first();
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
            $member->vacation = $request->get('vacation');
            if ($member->vacation == 1) {
                $vacationdate = new DateTime();
                $vacationdate = $vacationdate->format('Y-m-d');
                $member->vacationdate = $vacationdate;
            }
            $oldemail = Member::where('email', '=', $request->get('email'))->first();
            if ($oldemail === null) {
                $member->email = $request->get('email');
                // email was changed so send validation email and reset to unverified.
                $member->verified = 0;

                // validation email:
                $verification_code = str_random(30);
                $member->verification_code = $verification_code;
                $html = "Dear ".$member->firstname.",<br><br>"
                    ."Please verify your email address by clicking this link:<br><br><a href="
                    .$request->get('domain')."/verify/".$verification_code.">"
                    .$request->get('domain')."/verify/".$verification_code."</a><br><br>"
                    ."Thank you!<br><br>"
                    .$request->get('sitename')." Admin<br>"
                    ."".$request->get('domain')."<br><br><br>";

                \Mail::send(array(), array(), function ($message) use ($html, $request) {
                    $message->to($request->get('email'), $request->get('firstname') . ' ' . $request->get('lastname'))
                    ->subject($request->get('sitename') . ' Verification')
                    ->from($request->get('adminemail'), $request->get('adminname'))
                    ->setBody($html, 'text/html');
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
        // delete from other tables.
        Builder::where('userid', '=', $userid)->delete();
        License::where('userid', '=', $userid)->delete();
        Mail::where('userid', '=', $userid)->delete();
        $member->delete();
        Session::set('user', null);
        return Redirect::to('delete');

    }

}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;

class MembersController extends Controller
{

    /**
     * Show all members.
     *
     * @return Response
     */
    public function index() {
        $members = Member::all();
        return view('pages.admin.members', compact('members'));
    }

    /**
     * Save record for a new member.
     *
     * @return Response
     */
     public function store(Request $request) {
         // form validation.
         $rules = array(
             'firstname' => 'required|max:255',
             'lastname' => 'required|max:255',
             'userid' => 'required|max:255|unique:members',
             'password' => 'required|min:6|max:255',
             'email' => 'required|email|max:255|unique:members',
             'referid' => 'exists:members,userid, NULL',
         );
         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
             return Redirect::route('admin/members/index');
         } else {
            // create new member.
            $member = new Member;
            $member->userid = $request->get('userid');
            $member->password = bcrypt($request->get('password'));
            $member->firstname = $request->get('firstname');
            $member->lastname = $request->get('lastname');
             $member->email = $request->get('email');
            $member->referid = $request->get('referid');
             $signupdate = new DateTime();
             $signupdate = $signupdate->format('Y-m-d H:i:sP');
             $member->signupdate = $signupdate;
             $member->ip = $_SERVER['REMOTE_ADDR'];
             $member->referringsite = $_SERVER['HTTP_REFERER'];
             $member->save();
             Session::flash('message', 'Successfully created new member with UserID ' . $member->userid);
             return Redirect::route('admin/members/index');
         }

     }

    /**
     * Update member info.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {

        // form validation.
        $rules = array(
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'referid' => 'exists:members,userid, NULL',
            'verified' => 'required',
            'signupdate' => 'required|date_format:Y-m-d',
            'vacation' => 'required',
            'commission' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::route('admin/members/index');
        } else {
            // update record.
            $member = Member::find($id);
            if ($request->get('password') != "") {
                $member->password = bcrypt($request->get('password'));
            }
            $member->admin = $request->get('admin');
            $member->firstname = $request->get('firstname');
            $member->lastname = $request->get('lastname');
            $member->email = $request->get('email');
            $member->verified = $request->get('verified');
            $member->referid = $request->get('referid');
            $member->ip = $request->get('ip');
            $member->signupdate = $request->get('signupdate');
            $member->lastlogin = $request->get('lastlogin');
            $member->vacation = $request->get('vacation');
            $member->commission = $request->get('commission');
            $member->save();
            Session::flash('message', 'Successfully updated UserID ' . $member->userid);
            return Redirect::route('admin/members/index');
        }

    }

    /**
     * Delete a member.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $member = Member::find($id);
        $userid = $member->userid;
        $member->delete();
        Session::flash('message', 'Successfully deleted Member ID #' . $id);
        return Redirect::route('admin/members/index');

    }

}
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
             'password' => 'required|min:6|max:255|confirmed',
             'email' => 'required|email|max:255|unique:members',
             'referid' => 'exists:members,userid, NULL',
         );
         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
             return Redirect::to('admin/members')->withInput($request->all()); // "withInput" sends the "old" values back on error to prepopulate the form.
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
             $signupdate = $signupdate->format('Y-m-d');
             $member->signupdate = $signupdate;
             $member->ip = $_SERVER['REMOTE_ADDR'];
             $member->referringsite = $_SERVER['HTTP_REFERER'];
             $member->save();
             Session::flash('message', 'Successfully created new member with UserID ' . $member->userid);
             return Redirect::to('admin/members');
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
            'savepassword' => 'present|min:6|max:255',
            'savefirstname' => 'required|max:255',
            'savelastname' => 'required|max:255',
            'saveemail' => 'required|email|max:255|unique:members,email,'.$id,
            'savereferid' => 'exists:members,userid',
            'saveverified' => 'required',
            'savesignupdate' => 'required|date_format:Y-m-d',
            'savevacation' => 'required',
            'savecommission' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/members');
        } else {
            // update record.
            $member = Member::find($id);
            if ($request->get('savepassword') != "") {
                $member->password = bcrypt($request->get('savepassword'));
            }
            $member->admin = $request->get('saveadmin');
            $member->firstname = $request->get('savefirstname');
            $member->lastname = $request->get('savelastname');
            $member->email = $request->get('saveemail');
            $member->verified = $request->get('saveverified');
            $member->referid = $request->get('savereferid');
            $member->ip = $request->get('saveip');
            $member->signupdate = $request->get('savesignupdate');
            $member->lastlogin = $request->get('savelastlogin');
            $member->vacation = $request->get('savevacation');
            $member->commission = $request->get('savecommission');
            $member->save();
            Session::flash('message', 'Successfully updated UserID ' . $member->userid);
            return Redirect::to('admin/members');
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
        Session::flash('message', 'Successfully deleted member UserID: ' . $userid);
        return Redirect::to('admin/members');

    }

}
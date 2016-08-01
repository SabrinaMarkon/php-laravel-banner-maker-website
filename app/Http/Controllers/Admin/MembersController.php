<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

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
            'verified' => 'required',
            'signupdate' => 'required|date_format:Y-m-d',
            'vacation' => 'required',
            'commission' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/members');
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

        $member = Transaction::find($id);
        $member->delete();
        Session::flash('message', 'Successfully deleted transaction ID #' . $id);
        return Redirect::to('admin/transactions');

    }

}
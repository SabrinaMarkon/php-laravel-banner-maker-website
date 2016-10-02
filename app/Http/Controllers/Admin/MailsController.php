<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Mail;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;

class MailsController extends Controller
{

    /**
     * Show form to create new emails.
     *
     * @return Response
     */
    public function index() {
        $contents = Mail::where('userid', 'admin')->orderBy('subject', 'asc')->get();
        return view('pages.admin.mailout', compact('contents'));
    }

    /**
     * Save record for a new mail
     *
     * @return Response
     */
    public function store(Request $request) {

        // validate submission.
        $rules = array(
            'subject' => 'required|max:255',
            'url' => 'required|max:255',
            'message' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/mailout')->withInput($request->all());
        } else {
            // create new email.
            $mail = new Mail;
            $mail->userid = 'admin';
            $mail->subject = $request->get('subject');
            $mail->message = $request->get('message');
            $mail->url = $request->get('url');
            $approvedate = new DateTime();
            $approvedate = $approvedate->format('Y-m-d H:i:sP');
            $mail->approved = $approvedate;
            $mail->save = 1;
            if ($request->get('send')) {
                // send the newly created email right after saving.
                $mail->needtosend = 1;
                Session::flash('message', 'Successfully sent email!');
            } else{
                // just create the email without sending.
                Session::flash('message', 'Successfully created new email');
            }
            $mail->save();
            return Redirect::to('admin/mailout');
        }

    }


    /**
     * Display the specified  item.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request) {

        // get the item information for this email.
        $id = $request->get('id');
        $mail = Mail::find($id);
        Session::flash('mail', $mail);
        return Redirect::to('admin/mailout');

    }


    /**
     * Update the specified item in the database.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {

        // validate update submission.
        $rules = array(
            'subject' => 'required|max:255',
            'url' => 'required|max:255',
            'message' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // return to the form with the same data from the same db id to try again.
            $mail = Mail::find($id);
            Session::flash('errors', $validator->errors());
            Session::flash('mail', $mail);
            return Redirect::to('admin/mailout')->withInput($request->all());
        } else {
            // update the record in the database.
            $mail = Mail::find($id);
            $mail->userid = 'admin';
            $mail->subject = $request->get('subject');
            $mail->message = $request->get('message');
            $mail->url = $request->get('url');
            $approvedate = new DateTime();
            $approvedate = $approvedate->format('Y-m-d H:i:sP');
            $mail->approved = $approvedate;
            $mail->save = 1;
            if ($request->get('send')) {
                // send the existing email right after saving.
                $mail->needtosend = 1;
                Session::flash('message', 'Successfully sent email!');
            } else{
                // just save the existing email without sending it at this time.
                Session::flash('message', 'Successfully saved email');
            }
            $mail->save();
            return Redirect::to('admin/mailout');
        }

    }


    /**
     * Delete an item.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $mail = Mail::find($id);
        $mail->delete();
        Session::flash('message', 'Successfully deleted email message');
        return Redirect::to('admin/mailout');

    }


}

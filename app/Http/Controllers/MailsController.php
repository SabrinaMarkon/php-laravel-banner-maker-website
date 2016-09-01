<?php

namespace App\Http\Controllers;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Mail::where('userid', 'admin')->orderBy('subject', 'asc')->get(); // ahange 'admin' to userid when I get that working.
        return view('pages.maildownline', compact('contents'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate submission.
        $rules = array(
            'subject' => 'required|max:255',
            'url' => 'required|max:255',
            'message' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('maildownline')->withInput($request->all());
        } else {
            // create new email.
            $mail = new Mail;
            $mail->userid = $request->get('userid');
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
            return Redirect::to('maildownline');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // get the item information for this email.
        $id = $request->get('id');
        $mail = Mail::find($id);
        Session::flash('mail', $mail);
        return Redirect::to('maildownline');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
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
            return Redirect::to('maildownline')->withInput($request->all());
        } else {
            // update the record in the database.
            $mail = Mail::find($id);
            $mail->userid = $request->get('userid');
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
            return Redirect::to('maildownline');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mail = Mail::find($id);
        $mail->delete();
        Session::flash('message', 'Successfully deleted email message');
        return Redirect::to('maildownline');
    }
}

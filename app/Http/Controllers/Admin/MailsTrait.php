<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mail;
use App\Http\Controllers\Controller;
use DB;

trait MailsTrait {

    /**
     * Get an email and send it out.
     *
     * @return mixed
     */
    public function mailOut(Mail $mail) {

        // figure this out..we want to send the mail to all members in the background...
       /// ???
        $id = $mail->id;  // id is present even for newly created emails, as it is assigned to the last insert id.
        $subject = $mail->subject;
        $message = $mail->message;
        $url = $mail->url;
        $needtosend = 1;


    }

}
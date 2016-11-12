<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mail;
use App\Models\Member;
use App\Http\Controllers\Controller;

trait MailsTrait {

    /**
     * Get an email and send it out.
     *
     * @param  mail   mail object
     * @return mixed
     */
    public function mailOut(Mail $mail) {

        // NOT ACTUALLY USING THIS YET

        // Sending mail in the background to all members is done with a console job in Console\Commands\SendEmails.php
        // Not sure if I need this file anymore
//        $id = $mail->id;  // id is present even for newly created emails, as it is assigned to the last insert id.
//        $subject = $mail->subject;
//        $message = $mail->message;
//        $url = $mail->url;
//        $needtosend = 1;


    }

}
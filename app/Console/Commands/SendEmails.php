<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mail;
use App\Models\Member;
use App\Models\Setting;
use Datetime;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out emails from either the downline mailer or the admin mailer.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * Can be run manually from the command line with:    php artisan emails:send
     * Cronjob set up in protected function schedule()  in kernel.php
     * Don't forget the one server cronjob: * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
     *
     * @return mixed
     */
    public function handle()
    {
        $domain = '';
        $sitename = '';
        $adminemail = '';
        $adminname = '';

        // get all config settings.
        $settings = Setting::all();
        // get eaach config setting  needed.
        foreach($settings as $setting) {
            if ($setting->name == "domain") { $domain = $setting->setting; }
            if ($setting->name == "sitename") { $sitename = $setting->setting; }
            if ($setting->name == "adminemail") { $adminemail = $setting->setting; }
            if ($setting->name == "adminname") { $adminname = $setting->setting; }
        }
        // get all mails that are marked as pending mailout.
        $mails = Mail::where('needtosend', '=', 1)->where('sent', '=', NULL)->orderBy('id', 'asc')->get();
        // get all members that are verified.
        $members = Member::where('verified', '=', 1)->where('vacation', '=', 0)->orderBy('id', 'asc')->get();

        if ($mails) {
            // there are emails to send
            foreach($mails as $mail) {

                $sent = new Datetime();
                $sent = $sent->format('Y-m-d');
                $senderuserid = $mail->userid;
                $subject = $mail->subject;
                $html = $mail->message; // has to be set to $html so that $message below for sending the mail is not confused with this variable name.
                $url = $mail->url;

                if ($members) {
                    foreach ($members as $member) {
                        //$this->info($member->userid); // echo userid to test.

                        // the backslash is needed below before Mail so we know it is the Mail class not the Model (which is used in here as well).
                        \Mail::send(array(), array(), function ($message) use ($senderuserid, $subject, $html, $url, $member, $domain, $sitename, $adminemail, $adminname) {

                            $firstname = $member->firstname;
                            $lastname = $member->lastname;
                            $fullname = $firstname . ' ' . $lastname;
                            $userid = $member->userid;
                            $email = $member->email;
                            $affiliate_url = $domain . '/' . $userid;

                            $disclaimer = "--------------------------------------------------------------<br><br>";
                            $disclaimer .= "This is an advertisement from a member of ".$sitename.". You are receiving this because you are a double opted-in member of " . $sitename . " with userid " . $userid . "<br><br>";
                            $disclaimer .= "You can opt out of receiving all emails from this website by logging in and deleting your account here:<br><br><a href=\"" . $domain . "/login\">" . $domain . "/login</a><br><br>";
                            $disclaimer .= "Kindly allow up to 24 hours to stop receiving mail once you delete your account.<br><br>";
                            $disclaimer .= "Thank you,<br>$adminname<br>$sitename<br><br><br>";
                            $disclaimer .= "Live Removal Assistance or Questions: <a href=\"mailto:" . $adminemail . "\">" . $adminemail ."</a> or <a href=\"" . $domain . "/helpdesk\">" . $domain . "/helpdesk</a><br><br>";
                            $disclaimer .= "This email is sent in strict compliance with International spam laws.<br><br>";

                            // disclaimer.
                            $html = $html . "<br><br><br>" . $disclaimer;
                            $html = str_replace("~AFFILIATE_URL~", $affiliate_url, $html);
                            $html = str_replace("~USERID~", $userid, $html);
                            $html = str_replace("~FULLNAME~", $fullname, $html);
                            $html = str_replace("~FIRSTNAME~", $firstname, $html);
                            $html = str_replace("~LASTNAME~", $lastname, $html);
                            $html = str_replace("~EMAIL~", $email, $html);
                            $html = $html . "<br><br>Sent by: " . $senderuserid;
                            $subject = str_replace("~AFFILIATE_URL~", $affiliate_url, $subject);
                            $subject = str_replace("~USERID~", $userid, $subject);
                            $subject = str_replace("~FULLNAME~", $fullname, $subject);
                            $subject = str_replace("~FIRSTNAME~", $firstname, $subject);
                            $subject = str_replace("~LASTNAME~", $lastname, $subject);
                            $subject = str_replace("~EMAIL~", $email, $subject);

                           $message->to($email, $fullname)
                                ->subject($subject)
                                ->from($adminemail, $adminname)
                                ->setBody($html, 'text/html');

                        });

                    }
                }

                // update the mail record to show it has been sent.
                Mail::where('id', '=', $mail->id)->update(['needtosend' => 0, 'sent' => $sent]);
            } // end get emails to send
        } // if there are emails to send.
    }
}

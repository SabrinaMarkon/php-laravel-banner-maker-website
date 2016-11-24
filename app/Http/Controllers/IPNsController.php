<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Validator;
use DateTime;


///// NEED TO FINISH THIS MESS AND THE LICENSESCONTROLLER

class IPNsController extends Controller
{
    public function ipn(Request $request) {

        //echo "wtf";

        // STEP 1: Read POST data

        // reading posted data from directly from $_POST causes serialization
        // issues with array data in POST
        // reading raw POST data from input stream instead.
              //  $raw_post_data = file_get_contents('php://input');
                $raw_post_data = $request;
                $raw_post_array = explode('&', $raw_post_data);
                $myPost = array();
                foreach ($raw_post_array as $keyval) {
                    $keyval = explode ('=', $keyval);
                    if (count($keyval) == 2)
                        $myPost[$keyval[0]] = urldecode($keyval[1]);
                }
        // read the post from PayPal system and add 'cmd'
                $req = 'cmd=_notify-validate';
                if(function_exists('get_magic_quotes_gpc')) {
                    $get_magic_quotes_exists = true;
                }
                foreach ($myPost as $key => $value) {
                    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                        $value = urlencode(stripslashes($value));
                    } else {
                        $value = urlencode($value);
                    }
                    $req .= "&$key=$value";
                }
        // STEP 2: Post IPN data back to paypal to validate

        $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        if( !($res = curl_exec($ch)) ) {
            error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);

        // STEP 3: Inspect IPN validation result and act accordingly

        if (strcmp ($res, "VERIFIED") == 0) {
            echo "VERIFIED";

            $payment_status = $_POST['payment_status'];
            $amount = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];
            $txn_id = $_POST['txn_id'];
            $receiver_email = $_POST['receiver_email'];
            $paypal = $_POST['payer_email'];
            $quantity = $_POST['quantity'];
            $userid = $_POST['option_selection1'];
            $amountwithoutfee = $_POST["option_selection2"];
            $specialofferid = $_POST["option_selection3"];
            $item = $_POST['item_name'];

            if ($payment_status == "Completed" && $amount == $licenseprice) {



            }

        } else if (strcmp ($res, "INVALID") == 0) {
            echo "INVALID";
        }
         // no view.
    }


}

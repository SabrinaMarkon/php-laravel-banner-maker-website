<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Banner;
use App\Models\License;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Validator;
use DateTime;
use DateInterval;

class IPNsController extends Controller
{
    public function ipn(Request $request) {

        // STEP 1: Read POST data
        // Reading raw POST data from input stream from paypal is the usual approach:
        //  $raw_post_data = file_get_contents('php://input');
        // Normally this works but php://input can only be read ONCE and Laravel intercepts it. Therefore,
        // we have to get the raw post data from the framework with getContent:
                $raw_post_data = $request->getContent();
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
            $item = $_POST['item_name'];

            if ($payment_status === "Completed") {

                    $user = Member::where('userid', '=', $userid)->first();
                    if ($user) {
                        $referid = $user->referid;
                    } else {
                        // user not found.
                        exit;
                    }

                    // User purchased License upgrade.
                    if ($item === $request->get('sitename') . ' - White Label Banner License') {
                        $licensetype = $_POST["option_selection2"];
                        // create new license.
                        $license = new License;
                        $license->userid = $userid;
                        $licensepaiddate = new DateTime();
                        $licensepaiddate = $licensepaiddate->format('Y-m-d');
                        $license->licensepaiddate = $licensepaiddate;
                        $license->licensestartdate = $licensepaiddate;
                        $licenseenddate = new DateTime();
                        if ($licensetype === 'monthly') {
                            $licensecommission = $request->get('licensecommissionmonthly');
                            $interval = new DateInterval('P1M');
                            $licenseenddate->add($interval);
                            $licenseenddate->format('Y-m-d');
                        } else if ($licensetype === 'annually') {
                            $licensecommission = $request->get('licensecommissionannually');
                            $interval = new DateInterval('P1Y');
                            $licenseenddate->add($interval);
                            $licenseenddate->format('Y-m-d');
                        } else {
                            $licensecommission = $request->get('licensecommissionlifetime');
                            // licenseenddate should be null if lifeitme.
                            $licenseenddate = '';
                        }
                        $license->licenseenddate = $licenseenddate;
                        $license->save();

                        // assign commission.
                        $commission = Member::where('referid', $referid)->increment('commission', $licensecommission);

                       // add transaction.
                        $transaction = new Transaction;
                        $transaction->userid = $userid;
                        $transaction->transaction = $txn_id;
                        $transaction->description = 'White Label Banner License';
                        $transaction->datepaid = $licensepaiddate;
                        $transaction->amount = $amount;

                        // remove watermark from existing banners:
                        $banners = Banner::where('userid', '=', $userid)->get();
                        foreach ($banners as $banner) {
                            $bannercode = $banner->htmlcode;
                            // remove watermark:
                            $bannercode = preg_replace('#<div id="watermark"(.*?)</div>#', ' ', $bannercode);
                            // update file:

                            //
                            //
                            //
                            //

                            // update database with new html and new file name:
                            Banner::where('id', $banner-id)->update('htmlcode', $bannercode);
                        }

                        // email admin.
                        $html = "Dear " . $request->get('adminname') . ",<br><br>"
                            . "A new " . $request->get('sitename') . " license was purchased!<br><br>"
                            . "UserID: " . $userid . "<br>"
                            . "Amount: " . $amount . " " . $licensetype . "<br>"
                            . "Transaction ID: " . $txn_id . "<br>"
                            . "Sponsor: " . $referid . "<br>"
                            . "Commission: " . $licensecommission . "<br><br>"
                            . "" . $request->get('domain') . "<br><br><br>";
                        \Mail::send(array(), array(), function ($message) use ($html, $request) {
                            $message->to($request->get('adminemail'), $request->get('adminname'))
                                ->subject($request->get('sitename') . ' License Upgrade Notification')
                                ->from($request->get('adminemail'), $request->get('adminname'))
                                ->setBody($html, 'text/html');
                        });
                    }
                    // User purchased a product the admin has set up for sale:
                    else {
                        $productid = $_POST["option_selection2"];
                        $product = Product::find($productid);
                        if ($product !== null) {

                            // assign commission.
                           $commission = Member::where('referid', $referid)->increment('commission', $product->commission);

                            // add transaction.
                            $datepaid = new DateTime();
                            $datepaid = $datepaid->format('Y-m-d');
                            $transaction = new Transaction;
                            $transaction->userid = $userid;
                            $transaction->transaction = $txn_id;
                            $transaction->description = $product->name;
                            $transaction->datepaid = $datepaid;
                            $transaction->amount = $amount;

                            // email admin.
                            $html = "Dear " . $request->get('adminname') . ",<br><br>"
                                . "A new " . $request->get('sitename') . " product was purchased!<br>"
                                . "** You will need to now fulfill the order for the customer! **<br>"
                                . "UserID: " . $userid . "<br>"
                                . "Product: " . $product->name . "<br>"
                                . "Quantity: " . $product->quantity . "<br>"
                                . "Amount: " . $amount . "<br>"
                                . "Transaction ID: " . $txn_id . "<br>"
                                . "Sponsor: " . $referid . "<br>"
                                . "Commission: " . $product->commission . "<br><br>"
                                . "" . $request->get('domain') . "<br><br><br>";
                            \Mail::send(array(), array(), function ($message) use ($html, $request) {
                                $message->to($request->get('adminemail'), $request->get('adminname'))
                                    ->subject($request->get('sitename') . ' Product Purchase Notification')
                                    ->from($request->get('adminemail'), $request->get('adminname'))
                                    ->setBody($html, 'text/html');
                            });

                        }
                    }
            } else {
                // status is not completed, so see if it is a cancellation.

            }
        } else if (strcmp ($res, "INVALID") == 0) {
            // invalid payment.
            //  echo "Invalid";
            exit;
        }
         // no view.
    }


}

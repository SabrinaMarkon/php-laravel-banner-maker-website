<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use Response;

class BannersController extends Controller
{
    /**
     * Show all banners.
     *
     * @return Response
     */
    public function index() {
        return view('pages.banners');
    }

    /**
     * Download banner.
     *
     * @return Response
     */
    public function getbanner(Request $request) {

        //Get the base-64 string from data
        $img_val = $request->get('img_val');

        $filteredData = substr($img_val, strpos($img_val, ",")+1);
        //Decode the string
        $unencodedData = base64_decode($filteredData);

        //Save the image with a random filename.
        $dlfilelong = md5(rand(0,9999999));
        $dlfileshort = substr($dlfilelong, 0, 12);
        $today = date("YmdHis");
        $dlfile = $today . $dlfileshort . ".png";
        $dlfilepath = 'mybanners/' . $dlfile;

        // write the file to the server.
        file_put_contents('mybanners/' . $dlfile, $unencodedData);

        // save image into the banners database table.
        $banner = new Banner();
        $banner->userid = Session::get('user')->userid;
        $banner->htmlcode = trim($request->get('htmlcode'));
        $banner->filename = $dlfile;
        $banner->save();

        // open a download open/save dialog box for the user to download the file.
        $headers = array('Content-Type: image/png');
        return Response::download($dlfilepath, $dlfile, $headers);
    }

}

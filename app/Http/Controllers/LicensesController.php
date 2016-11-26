<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;

class LicensesController extends Controller
{
    /**
     * Get licenses for the user.
     *
     * @return Response
     */
    public function index() {
        // find out of the user has a current license.
        $license = License::where('userid', '=', Session::get('user')->userid)->where('licenseenddate', '>=', new DateTime('now'))->orderBy('id', 'desc')->first();
        if ($license) {
            $licenseenddate = new DateTime($license->licenseenddate);
            $licenseenddate = $licenseenddate->format('Y-m-d');
        }
        // get the admin's content for the license sales page.
        $page = Page::where('slug', '=', 'license')->first();
        return view('pages.license', compact('page', 'licenseenddate'));
    }

    /**
     *  Add a new license for the user.
     *
     * @return Response
     */
    public function store(Request $request) {
        // validate
        $rules = array (
            'userid' => 'required|max:255|exists:members',
            'licensepaiddate' => 'required|date_format:Y-m-d',
            'licensestartdate' => 'required|date_format:Y-m-d',
            'licenseenddate' => 'required|date_format:Y-m-d',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator.fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('licenses');
        } else {
            // create new license.
            $license = new License;
            $license->userid = $request->get('userid');
            $license->licensepaiddate = $request->get('licensepaiddate');
            $license->licensestartdate = $request->get('licensestartdate');
            $license->licenseenddate = $request->get('licenseenddate');
            $license->save();
            Session::flash('message', 'Successfully Upgraded Your License!');
            return Redirect::to('licenses');
        }
    }


}
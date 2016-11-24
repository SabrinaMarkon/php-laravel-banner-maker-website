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
        // get the admin's content for the license sales page if they've written any.
        $page = Page::where('slug', '=', 'license')->first();
        return view('pages.license', compact('page'));
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
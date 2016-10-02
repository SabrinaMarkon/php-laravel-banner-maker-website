<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;

class LicensesController extends Controller
{

    /**
     * Show all licenses.
     *
     * @return Response
     */
    public function index()
    {
        $licenses = License::orderBy('licenseenddate', 'desc')->orderBy('id', 'desc')->get();
        $userids = Member::orderBy('userid', 'asc')->get();
        return view('pages.admin.licenses', compact('licenses', 'userids'));
    }

    /**
     * Save record for a new license.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // form validation.
        $rules = array(
            'userid' => 'required|max:255|exists:members',
            'licensepaiddate' => 'required|date_format:Y-m-d',
            'licensestartdate' => 'required|date_format:Y-m-d',
            'licenseenddate' => 'required|date_format:Y-m-d',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/licenses')->withInput($request->all()); // "withInput" sends the "old" values back on error to prepopulate the form.
        } else {
            // create new license.
            $license = new License;
            $license->userid = $request->get('userid');
            $license->licensepaiddate = $request->get('licensepaiddate');
            $license->licensestartdate = $request->get('licensestartdate');
            $license->licenseenddate = $request->get('licenseenddate');
            $license->save();
            Session::flash('message', 'Successfully created new license for UserID ' . $license->userid);
            return Redirect::to('admin/licenses');
        }

    }

    /**
     * Update license details.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {

        // form validation.
        $rules = array(
            'userid' => 'required|max:255|exists:members',
            'licensepaiddate' => 'required|date_format:Y-m-d',
            'licensestartdate' => 'required|date_format:Y-m-d',
            'licenseenddate' => 'required|date_format:Y-m-d',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/licenses');
        } else {
            // update record.
            $license = License::find($id);
            $license->userid = $request->get('userid');
            $license->licensepaiddate = $request->get('licensepaiddate');
            $license->licensestartdate = $request->get('licensestartdate');
            $license->licenseenddate = $request->get('licenseenddate');
            $license->save();
            Session::flash('message', 'Successfully updated License');
            return Redirect::to('admin/licenses');
        }

    }

    /**
     * Delete a license.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {

        $license = License::find($id);
        $license->delete();
        Session::flash('message', 'Successfully deleted License');
        return Redirect::to('admin/licenses');

    }

}
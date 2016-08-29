<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

class LicensesController extends Controller
{
    /**
     * Show all user license records.
     *
     * @return Response
     */
    public function index() {
        $contents = License::orderBy('userid', 'asc')->get();
        return view('pages.admin.licenses', compact('contents'));
    }

    /**
     * Save user license.
     *
     * @return Response
     */
    public function store(Request $request) {

        // validate submission.
        $rules = array(
            'productname' => 'required|max:255|unique:products,name',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|min:0.01',
            'commission' => 'required|min:0.00',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/licenses')->withInput($request->all());
        } else {
            // create new item.
            $license = new License;
            $license->userid = $request->get('userid');


            $license->save();
            $userid = $license->userid;
            Session::flash('message', 'Successfully added new license for member: ' . $userid);
            return Redirect::to('admin/licenses');
        }

    }

    /**
     * Update the specified item in the database.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {

        // validate update submission.
        $rules = array(
            'productname' => 'required|max:255',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|min:0.01',
            'commission' => 'required|min:0.00',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // return to the form with the same data from the same db id to try again.
            $license = License::find($id);
            Session::flash('errors', $validator->errors());
            Session::flash('license', $license);
            return Redirect::to('admin/licenses')->withInput($request->all());
        } else {
            // update the record in the database.
            $license = License::find($id);
            $license->userid = $request->get('userid');



            $license->save();
            Session::flash('message', 'Successfully saved license');
            return Redirect::to('admin/licenses');
        }

    }


    /**
     * Delete a license.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $license = License::find($id);
        $license->delete();
        Session::flash('message', 'Successfully deleted license');
        return Redirect::to('admin/licenses');

    }



}

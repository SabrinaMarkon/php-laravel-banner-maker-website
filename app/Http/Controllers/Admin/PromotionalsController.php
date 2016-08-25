<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Promotional;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

class PromotionalsController extends Controller
{
    /**
     * Show form to make new promotional material and all promotional materials
     *
     * @return Response
     */
    public function index() {
        $contents = Promotional::orderBy('type', 'asc')->orderBy('name', 'asc')->get();
        return view('pages.admin.promotionals', compact('contents'));
    }

    /**
     * Save record for a new promotional item.
     *
     * @return Response
     */
    public function store(Request $request) {

        // validate submission.
        $rules = array(
            'promotionalname' => 'required|max:255|alpha_num|unique:promotional,name',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/promotionals')->withInput($request->all());
        } else {
            // create new item.
            $promotional = new Promotional;
            $promotional->name = $request->get('promotionalname');
            $promotional->type = $request->get('type');
            $promotional->p_image = $request->get('p_image');
            $promotional->p_subject = $request->get('p_subject');
            $promotional->p_message = $request->get('p_message');
            $promotional->save();
            Session::flash('message', 'Successfully created new ' . $promotional->type);
            return Redirect::to('admin/promotionals');
        }

    }


    /**
     * Display the specified  item.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request) {

        // get the item information for this id.
        $id = $request->get('id');
        $promotional = Promotional::find($id);
        Session::flash('promotional', $promotional);
        return Redirect::to('admin/promotionals');

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
            'promotionalname' => 'required|max:255|alpha_num',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // return to the form with the same data from the same db id to try again.
            $promotional = Promotional::find($id);
            Session::flash('errors', $validator->errors());
            Session::flash('promotional', $promotional);
            return Redirect::to('admin/promotionals')->withInput($request->all());
        } else {
            // update the record in the database.
            $promotional = Promotional::find($id);
            $promotional->name = $request->get('promotionalname');
            $promotional->type = $request->get('type');
            $promotional->p_image = $request->get('p_image');
            $promotional->p_subject = $request->get('p_subject');
            $promotional->p_message = $request->get('p_message');
            $promotional->save();
            $promotionalname = $promotional->name;
            Session::flash('message', 'Successfully saved promotional ad: ' . $promotionalname);
            return Redirect::to('admin/promotionals');
        }

    }


    /**
     * Delete an item.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $promotional = Promotional::find($id);
        $promotionalname = $promotional->name;
        $promotional->delete();
        Session::flash('message', 'Successfully deleted promotional ad: ' . $promotionalname);
        return Redirect::to('admin/promotionals');

    }



}

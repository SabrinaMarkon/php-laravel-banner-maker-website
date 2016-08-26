<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Faq;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

class FaqsController extends Controller
{

    use FaqsTrait;

    /**
     * Show all faqs.
     *
     * @return Response
     */
    public function index() {
        $faqs = Faq::orderBy('positionnumber', 'asc')->get();
        $faqs_id_order = "";
        foreach ($faqs as $faq) {
            $faqs_id_order = $faqs_id_order . "ID[]=" . $faq->id . "&";
        }
        $faqs_id_order = substr($faqs_id_order, 0, -1);
        return view('pages.admin.faqs', compact('faqs', 'faqs_id_order'));
    }


    /**
     * Create a new faq.
     *
     * @return Response
     */
    public function store(Request $request) {
        // validation
        $rules = array (
            'question' => 'required|unique:faqs',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/faqs');
        } else {
            $faq = new Faq;
            $faq->question = $request->get('question');
            $faq->answer = $request->get('answer');
            $faq->positionnumber = $this->getLast();
            $faq->save();
            Session::flash('message', 'Successfully created a new FAQ');
            return Redirect::to('admin/faqs');
        }

    }


/**
 * Save changed to an existing faq.
 *
 * @param int $id
 * @return Response
 */
public function update($id, Request $request) {
    // validation
    $question = 'question' . $id;
    $rules = array(
        "$question" => 'required',
    );
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        Session::flash('errors', $validator->errors());
        return Redirect::to('admin/faqs');
    } else {
        $faq = Faq::find($id);
        $faq->question = $request->get('question' . $id);
        $faq->answer = $request->get('answer' . $id);
        //$faq->positionnumber = $request->get('positionnumber' . $id);
        $faq_id_order = $request->get('positionnumber' . $id);
        $this->saveOrder($faq_id_order);
        $faq->save();
        Session::flash('message', 'Successfully saved the FAQ');
        return Redirect::to('admin/faqs');
    }

}


    /**
     * Delete an faq.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id, Request $request) {
        $faq = Faq::find($id);
        $question = $faq->question;
        $faq->delete();
        Session::flash('message', 'Successfully deleted the FAQ');
        return Redirect::to('admin/faqs');
    }


}

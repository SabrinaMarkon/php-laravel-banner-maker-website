<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use View;

class ContentController extends Controller
{
    /**
     * Show content editing form and dropdown with all pages.
     *
     * @return Response
     */
    public function index() {

        $contents = Page::orderBy('name')->get();
        return view('pages.admin.content', compact('contents'));

    }


    /**
     * Save record for a new page.
     *
     * @return Response
     */
    public function store(Request $request) {

        // validate form
        $rules = array(
            'pagename' => 'required|max:255|unique:pages,name',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/content')->withInput($request->all());
        } else {
            // create the new page.
            $page = new Page;
            $page->name = $request->get('pagename');
            $page->slug = str_slug($request->get('pagename'));
            $page->htmlcode = $request->get('pagecontent');
            $page->save();
            Session::flash('message', 'Successfully created new page!');
            return Redirect::to('admin/content');
        }

    }


    /**
     * Display the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request)
    {
        // get the page content for this id.
        $id = $request->get('id');
        $page = Page::find($id);
        Session::flash('page', $page);
        return Redirect::to('admin/content');
    }


    /**
     * Update the specified page in the database.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {

        // validate the updated content.
        $rules = array(
            'pagename' => 'required|max:255',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // return to the form with the same data from the same db page id to try again.
            $page = Page::find($id);
            Session::flash('errors', $validator->errors());
            Session::flash('page', $page);
            return Redirect::to('admin/content')->withInput($request->all());
        } else {
            // update the page content in the database.
            $page = Page::find($id);
            $page->name = $request->get('pagename');
            $page->slug = str_slug($request->get('pagename'));
            $page->htmlcode = $request->get('pagecontent');
            $page->save();
            Session::flash('message', 'Successfully saved the ' . $page->name . ' page!');
            return Redirect::to('admin/content');
        }

    }


    /**
     * Delete a page.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $page = Page::find($id);
        $pagename = $page->pagename;
        $page->delete();
        Session::flash('message', 'Successfully deleted Page: ' . $pagename);
        return Redirect::to('admin/content');

    }


}

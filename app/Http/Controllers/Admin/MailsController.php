<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class MailsController extends Controller
{
    /**
     * Show all saved emails.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('pages.admin.mailout');
    }


    /**
     * Create and send a new email message.
     *
     * @param Request $request
     */
    public function store(Request $request) {

    }


    /**
     * Update an existing email.
     *
     * @param $id  The id of the saved email.
     * @param Request $request
     */
    public function update($id, Request $request) {

    }


    /**
     * Delete a saved email.
     *
     * @param $id  The id of the email.
     * @param Request $request
     */
    public function destroy($id, Request $request) {

    }


}

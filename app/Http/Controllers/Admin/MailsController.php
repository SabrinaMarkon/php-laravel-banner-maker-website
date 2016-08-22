<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class MailsController extends Controller
{
    // list all emails
    public function index() {
        return view('pages.admin.mailout');
    }


}

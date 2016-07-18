<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MailsController extends Controller
{
    // list all emails
    public function index() {
        return view('mails.index');
    }
}

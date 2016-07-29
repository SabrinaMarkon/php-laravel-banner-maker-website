<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

uses App\Http\Controllers\Controller;

class TransactionsController extends Controller
{
    // list all financial transactions
    public function index() {
        return view('pages.admin.transactions');
    }
}

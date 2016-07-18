<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TransactionsController extends Controller
{
    // list all financial transactions
    public function index() {
        return view('transactions.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductsController extends Controller
{
    // list all products for sale
    public function index() {
        return view('pages.admin.products');
    }
}

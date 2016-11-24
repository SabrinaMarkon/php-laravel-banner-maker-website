<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Validator;
use DateTime;

class IPNsController extends Controller
{
    public function ipn(Request $request) {
        echo "wtf";

        // no view.
    }
}

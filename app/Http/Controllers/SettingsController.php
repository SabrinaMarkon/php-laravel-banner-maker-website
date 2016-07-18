<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    // get all site settings
    public function index() {
        return view('settings.index');
    }
}

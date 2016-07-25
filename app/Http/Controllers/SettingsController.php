<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Setting;

class SettingsController extends Controller
{
    public function index() {
        // get all site settings
        //$settings = DB::table('settings')->get(); // other way with use DB
        $settings = Setting::all();
        return view('pages.admin.settings', compact('settings'));
    }


}

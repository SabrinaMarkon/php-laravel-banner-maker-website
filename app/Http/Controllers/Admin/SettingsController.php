<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Setting;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index() {
        // get all site settings
        //$settings = DB::table('settings')->get(); // other way with use DB
        $settings = Setting::all();
        return view('pages.admin.settings', compact('settings'));
    }


}

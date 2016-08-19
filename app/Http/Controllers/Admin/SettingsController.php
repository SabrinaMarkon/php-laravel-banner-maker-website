<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use DB;

class SettingsController extends Controller
{
    public function index() {
        // get all site settings
        //$settings = DB::table('settings')->get(); // other way with use DB
        $settings = Setting::all();
        return view('pages.admin.settings', compact('settings'));
    }

    public function store(Request $request) {
        $input = $request->all();
        foreach ($input as $key => $val) {
           // echo $key . "-" . $val ."<br>";
            DB::table('settings')->where('name', $key)->update(['setting' => $val]);
            Session::flash('message', 'Successfully updated the site settings!');
            return Redirect::to('admin/settings');
        }
    }


}

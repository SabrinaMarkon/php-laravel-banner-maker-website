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
        $input = $request->except(['_method', '_token']); // expect method because there is an error if we try to save the token as if it were a setting.
        foreach ($input as $key => $val) {
           //echo $key . "-" . $val ."<br>";
            Setting::query()->where('name', $key)->update(array('setting' => $val));
        }
        Session::flash('message', 'Successfully updated the site settings!');
        return Redirect::to('admin/settings');
    }


}

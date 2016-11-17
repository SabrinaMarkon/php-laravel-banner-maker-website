<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use File;

class BannersController extends Controller
{
    // list all banners
    public function index() {
        $banners = Banner::orderBy('id')->get();
        return view('pages.admin.banners', compact('banners'));
    }

    public function destroy($id, Request $request) {
        $banner = Banner::find($id);
        // delete the file:
        $filename = $banner->filename;
        $filepath = '../mybanners/' . $filename;
        File::delete($filepath);
        // delete the record:
        $banner->delete();
        Session::flash('message', 'The banner was deleted');
        return Redirect::to('admin/banners');
    }

    
}

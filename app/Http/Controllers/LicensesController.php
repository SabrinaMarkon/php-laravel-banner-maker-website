<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Models\LicenseDLB;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use DateTime;

class LicensesController extends Controller
{
    /**
     * Get licenses for the user.
     *
     * @return Response
     */
    public function index() {
        // find out of the user has a current license.
        $license = License::where('userid', '=', Session::get('user')->userid)->where('licenseenddate', '>=', new DateTime('now'))->orderBy('id', 'desc')->first();
        if ($license) {
            $licenseenddate = new DateTime($license->licenseenddate);
            $licenseenddate = $licenseenddate->format('Y-m-d');
        } else {
            $licenseenddate = '';
        }
        // get the admin's content for the license sales page.
        $page = Page::where('slug', '=', 'license')->first();
        return view('pages.license', compact('page', 'licenseenddate'));
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\License;
use App\Models\LicenseDLBSilver;
use App\Models\LicenseDLBGold;
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
        // find out of the user has a current banner watermark license.
        $license = License::where('userid', '=', Session::get('user')->userid)->where('licenseenddate', '>=', new DateTime('now'))->orderBy('id', 'desc')->first();
        if ($license) {
            $licenseenddate = new DateTime($license->licenseenddate);
            $licenseenddate = $licenseenddate->format('Y-m-d');
        } else {
            $licenseenddate = '';
        }

        // find out if the user has a current gold downline builder license:
        $licensedlbgold = LicenseDLBGold::where('userid', '=', Session::get('user')->userid)->where('licenseenddate', '>=', new DateTime('now'))->orderBy('id', 'desc')->first();
        if ($licensedlbgold) {
            $licensedlbgoldenddate = new DateTime($licensedlbgold->licenseenddate);
            $licensedlbgoldenddate = $licensedlbgoldenddate->format('Y-m-d');
        } else {
            $licensedlbgoldenddate = '';
        }

        // find out if the user has a current silver downline builder license:
        $licensedlbsilver = LicenseDLBSilver::where('userid', '=', Session::get('user')->userid)->where('licenseenddate', '>=', new DateTime('now'))->orderBy('id', 'desc')->first();
        if ($licensedlbsilver) {
            $licensedlbsilverenddate = new DateTime($licensedlbsilver->licenseenddate);
            $licensedlbsilverenddate = $licensedlbsilverenddate->format('Y-m-d');
        } else {
            $licensedlbsilverenddate = '';
        }

        // in the view, if the user has an active gold license, no order button. If the user has no gold but has an active silver license, upgrade order button. Otherwise, full order button.

        // get the admin's content for the license sales page.
        $page = Page::where('slug', '=', 'license')->first();
        return view('pages.license', compact('page', 'licenseenddate', 'licensedlbgoldenddate', 'licensedlbsilverenddate'));
    }

}
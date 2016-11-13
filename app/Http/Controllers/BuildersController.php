<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Builder;
use App\Models\Builder_cat;
use App\Models\Builder_site;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

class BuildersController extends Controller
{
    use BuildersTrait;

    /**
     * Show all builder categories.
     *
     * @return Response
     */
    public function index() {

        // get categories
        $categories = Builder_cat::orderBy('positionnumber', 'asc')->get();
        $categories_id_order = "";
        foreach ($categories as $category) {
            $categories_id_order = $categories_id_order . "ID[]=" . $category->id . "&";
        }
        $categories_id_order = substr($categories_id_order, 0, -1);

        // get users own programs
        $userprograms= Builder::where('userid', Session::get('user')->userid)->orderBy('category', 'asc')->orderBy('positionnumber', 'asc')->get();
        $userprograms_id_order = "";
        foreach ($userprograms as $userprogram) {
            $userprograms_id_order = $userprograms_id_order . "ID[]=" . $userprogram->id . "&";
        }
        $userprograms_id_order = substr($userprograms_id_order, 0, -1);

        // get users sponsors programs
        $sponsorprograms= Builder::where('userid', Session::get('user')->referid)->orderBy('category', 'asc')->orderBy('positionnumber', 'asc')->get();
        $sponsorprograms_id_order = "";
        foreach ($sponsorprograms as $sponsorprogram) {
            $sponsorprograms_id_order = $sponsorprograms_id_order . "ID[]=" . $sponsorprogram->id . "&";
        }
        $sponsorprograms_id_order = substr($sponsorprograms_id_order, 0, -1);

        // get admin programs
        $adminprograms= Builder_site::orderBy('category', 'asc')->orderBy('positionnumber', 'asc')->get();
        $adminprograms_id_order = "";
        foreach ($adminprograms as $adminprogram) {
            $adminprograms_id_order = $adminprograms_id_order . "ID[]=" . $adminprogram->id . "&";
        }
        $adminprograms_id_order = substr($adminprograms_id_order, 0, -1);

        return view('pages.dlb', compact('categories', 'categories_id_order', 'userprograms', 'userprograms_id_order', 'sponsorprograms', 'sponsorprograms_id_order', 'adminprograms', 'adminprograms_id_order'));
    }


    /**
     * Create a new program.
     *
     * @return Response
     */
    public function store(Request $request) {

            // user wants to create a new program for the builder.
            // validation
            $rules = array(
                'name' => 'required|unique:builder_sites',
                'category' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                return Redirect::to('dlb')->withInput($request->all());
            } else {
                $builder = new Builder;
                $builder->userid = Session::get('user')->userid;
               // $builder->userid = $request->get('userid');
                $builder->name = $request->get('name');
                $builder->desc = $request->get('desc');
                $builder->url = $request->get('url');
                if ($request->get('bold') == 1) {
                    $builder->bold = 1;
                } else {
                    $builder->bold = 0;
                }
                $builder->color = $request->get('color');
                $builder->category = $request->get('category');
                $builder->positionnumber = $this->getlast();
                $builder->save();
                Session::flash('message', 'Successfully create a new builder program');
                return Redirect::to('dlb');
            }

    }


    /**
     * Save changed to an existing program.
     *
     * @param int $id
     * @return Response
     */
    public function update($id, Request $request) {

            // The user wants to edit and save one of their programs.
            // validation
            $rules = array(
                'name' . $id => 'required',
                'category' . $id => 'required',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                return Redirect::to('dlb')->withInput($request->all());
            } else {
                $builder = Builder::find($id);
                $builder->name = $request->get('name' . $id);
                $builder->desc = $request->get('desc' . $id);
                $builder->url = $request->get('url' . $id);
                if ($request->get('bold' . $id) == 1) {
                    $builder->bold = 1;
                } else {
                    $builder->bold = 0;
                }
                $builder->color = $request->get('color' . $id);
                $builder->category = $request->get('category' . $id);
                $builder_id_order = $request->get('positionnumber' . $id);
                $this->saveOrder($builder_id_order);
                $builder->save();
                Session::flash('message', 'Successfully saved the builder program');
                return Redirect::to('dlb');
            }
    }


    /**
     * Delete a program.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id, Request $request) {

            // if we want to delete an existing program.
            $program = Builder::find($id);
            $program->delete();
            Session::flash('message', 'Successfully deleted the program');
            return Redirect::to('dlb');
    }


}

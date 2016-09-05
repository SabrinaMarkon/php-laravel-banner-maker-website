<?php

namespace App\Http\Controllers\Admin;

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

        // get programs
        //$programs= Builder_site::orderBy('category', 'asc')->orderBy('positionnumber', 'asc')->get();
        $programs= Builder_site::orderBy('positionnumber', 'asc')->get();
        $programs_id_order = "";
        foreach ($programs as $program) {
            $programs_id_order = $programs_id_order . "ID[]=" . $program->id . "&";
        }
        $programs_id_order = substr($programs_id_order, 0, -1);

        return view('pages.admin.dlb', compact('categories', 'categories_id_order', 'programs', 'programs_id_order'));
    }


    /**
     * Create a new category.
     *
     * @return Response
     */
    public function store(Request $request) {

        if ($request->get('createcategory')) {
            // if we want to create a new category.
            // validation
            $rules = array(
                'name' => 'required|unique:builder_cat',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                return Redirect::to('admin/dlb');
            } else {
                $builder = new Builder_cat;
                $builder->name = $request->get('name');
                $builder->positionnumber = $this->getLast('category');
                $builder->save();
                Session::flash('message', 'Successfully created a new category');
                return Redirect::to('admin/dlb');
            }
        } else {
            // if we want to create a new program.
            // validation
            $rules = array(
                'name' => 'required|unique:builder_sites',
                'category' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                return Redirect::to('admin/dlb');
            } else {
                $builder = new Builder_site;
                $builder->name = $request->get('name');
                $builder->desc = $request->get('desc');
                $builder->url = $request->get('url');
                $builder->category = $request->get('category');
                $builder->positionnumber = $this->getlast('program');
                $builder->save();
                Session::flash('message', 'Successfully create a new builder program');
                return Redirect::to('admin/dlb');
            }
        }

    }


    /**
     * Save changed to an existing category.
     *
     * @param int $id
     * @return Response
     */
    public function update($id, Request $request) {

        if ($request->get('savecategory')) {
            // if we want to update an existing category.
            // validation
            $name = 'name' . $id;
            $rules = array(
                "$name" => 'required',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                return Redirect::to('admin/dlb');
            } else {
                $builder = Builder_cat::find($id);
                $builder->name = $request->get('name' . $id);
                //$builder->positionnumber = $request->get('positionnumber' . $id);
                $builders_id_order = $request->get('positionnumber' . $id);
                $this->saveOrder('category', $builders_id_order);
                $builder->save();
                Session::flash('message', 'Successfully saved the category');
                return Redirect::to('admin/dlb');
            }
        } else {
            // if we want to save an existing program.
            // validation
            $rules = array(
                'name' . $id => 'required',
                'category' . $id => 'required',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                return Redirect::to('admin/dlb');
            } else {
                $builder = Builder_site::find($id);
                $builder->name = $request->get('name' . $id);
                $builder->desc = $request->get('desc' . $id);
                $builder->url = $request->get('url' . $id);
                $builder->category = $request->get('category' . $id);
                $builder_id_order = $request->get('positionnumber' . $id);
                $this->saveOrder('program', $builder_id_order);
                $builder->save();
                Session::flash('message', 'Successfully saved the builder program');
                return Redirect::to('admin/dlb');
            }
        }

    }


    /**
     * Delete a category.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        if ($request->get('deletecategory')) {
            // if we want to delete an existing category.
            $category = Builder_cat::find($id);
            $category->delete();
            Session::flash('message', 'Successfully deleted the category');
            return Redirect::to('admin/dlb');
        } else {
            // if we want to delete an existing program.
            $program = Builder_site::find($id);
            $program->delete();
            Session::flash('message', 'Successfully deleted the program');
            return Redirect::to('admin/dlb');
        }
    }


}

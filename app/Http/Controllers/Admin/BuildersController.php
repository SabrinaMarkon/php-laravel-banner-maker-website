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
        $builders = Builder_cat::orderBy('positionnumber', 'asc')->get();
        $builders_id_order = "";
        foreach ($builders as $builder) {
            $builders_id_order = $builders_id_order . "ID[]=" . $builder->id . "&";
        }
        $builders_id_order = substr($builders_id_order, 0, -1);
        return view('pages.admin.dlb', compact('builders', 'builders_id_order'));
    }


    /**
     * Create a new category.
     *
     * @return Response
     */
    public function store(Request $request) {
        // validation
        $rules = array (
            'name' => 'required|unique:builder_cat',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/dlb');
        } else {
            $builder = new Builder_cat;
            $builder->name = $request->get('name');
            $builder->positionnumber = $this->getLast();
            $builder->save();
            Session::flash('message', 'Successfully created a new category');
            return Redirect::to('admin/dlb');
        }

    }


    /**
     * Save changed to an existing category.
     *
     * @param int $id
     * @return Response
     */
    public function update($id, Request $request) {
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
            $this->saveOrder($builders_id_order);
            $builder->save();
            Session::flash('message', 'Successfully saved the category');
            return Redirect::to('admin/dlb');
        }

    }


    /**
     * Delete a category.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id, Request $request) {
        $builder = Builder_cat::find($id);
        $builder->delete();
        Session::flash('message', 'Successfully deleted the category');
        return Redirect::to('admin/dlb');
    }


}

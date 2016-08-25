<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

class ProductsController extends Controller
{
    /**
     * Show form to make new products for sale on the site, such as the white label license
     *
     * @return Response
     */
    public function index() {
        $contents = Product::orderBy('name', 'asc')->get();
        return view('pages.admin.products', compact('contents'));
    }

    /**
     * Save record for a new product to sell on the website.
     *
     * @return Response
     */
    public function store(Request $request) {

        // validate submission.
        $rules = array(
            'productname' => 'required|max:255|alpha_num|unique:products,name',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|min:0.01',
            'commission' => 'required|min:0.00',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/products')->withInput($request->all());
        } else {
            // create new item.
            $product = new Product;
            $product->name = $request->get('productname');
            $product->description = $request->get('description');
            $product->quantity = $request->get('quantity');
            $product->price = $request->get('price');
            $product->commission = $request->get('commission');
            $product->save();
            $productname = $product->name;
            Session::flash('message', 'Successfully created new product: ' . $productname);
            return Redirect::to('admin/products');
        }

    }


    /**
     * Display the specified  item.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request) {

        // get the item information for this product.
        $id = $request->get('id');
        $product = Product::find($id);
        Session::flash('product', $product);
        return Redirect::to('admin/products');

    }


    /**
     * Update the specified item in the database.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {

        // validate update submission.
        $rules = array(
            'productname' => 'required|max:255|alpha_num',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|min:0.01',
            'commission' => 'required|min:0.00',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // return to the form with the same data from the same db id to try again.
            $product = Product::find($id);
            Session::flash('errors', $validator->errors());
            Session::flash('product', $product);
            return Redirect::to('admin/products')->withInput($request->all());
        } else {
            // update the record in the database.
            $product = Product::find($id);
            $product->name = $request->get('productname');
            $product->description = $request->get('description');
            $product->quantity = $request->get('quantity');
            $product->price = $request->get('price');
            $product->commission = $request->get('commission');
            $product->save();
            $productname = $product->name;
            Session::flash('message', 'Successfully saved product: ' . $productname);
            return Redirect::to('admin/products');
        }

    }


    /**
     * Delete an item.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $product = Product::find($id);
        $productname = $product->name;
        $product->delete();
        Session::flash('message', 'Successfully deleted product: ' . $productname);
        return Redirect::to('admin/products');

    }



}

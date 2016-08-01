<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;

class TransactionsController extends Controller
{

    /**
     * Show all transactions.
     *
     * @return Response
     */
    public function index() {
        $transactions = Transaction::all();
        return view('pages.admin.transactions', compact('transactions'));
    }

    /**
     * Update transaction data.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {

        // validation of the form.
        $rules = array(
            'userid' => 'required|max:255|exists:members,userid',
            'transaction' => 'required|max:255',
            'datepaid' => 'required|date_format:Y-m-d',
            'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return Redirect::to('admin/transactions');
        } else {
            // update record.
            $transaction = Transaction::find($id);
            $transaction->userid = $request->get('userid');
            $transaction->transaction = $request->get('transaction');
            $transaction->datepaid = $request->get('datepaid');
            $transaction->amount = $request->get('amount');
            $transaction->save();
            Session::flash('message', 'Successfully updated transaction ID #' . $id);
            return Redirect::to('admin/transactions');
        }

    }

    /**
     * Remove the specified transaction.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {

        $transaction = Transaction::find($id);
        $transaction->delete();
        Session::flash('message', 'Successfully deleted transaction ID #' . $id);
        return Redirect::to('admin/transactions');

    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {

      // dd($request);

      $AdditionalData = [
        'user_id' => $request->input('user_id'),
        'paymentType' => $request->input('paymentType'),
        'description' => $request->input('description'),
        'total_price' => $request->input('total_price'),
        'date' => $request->input('date'),
        'due_date' => $request->input('due_date'),
        'address' => $request->input('address'),
        'email' => $request->input('email')
      ];

      $invoice =  Invoice::create($AdditionalData);

      $invoice_id = $invoice->id;

      $FormData = [
        'product_id' => $request->input('product_id'),
        'invoice_id' => $invoice_id,
        'quantity' => $request->input('quantity'),
        'price' => $request->input('price')
      ];



      Item::create($FormData);

      return redirect(route('Index'));
    }

    public function update(Request $request , $id)
    {
            // dd($request);

            $AdditionalData = [
              'user_id' => $request->input('user_id'),
              'paymentType' => $request->input('paymentType'),
              'description' => $request->input('description'),
              'total_price' => $request->input('total_price'),
              'date' => $request->input('date'),
              'due_date' => $request->input('due_date'),
              'address' => $request->input('address'),
              'email' => $request->input('email')
            ];

            $invoice =  Invoice::findOrFail($id)->update($AdditionalData);

            $invoice_id = $invoice->id;

            $FormData = [
              'product_id' => $request->input('product_id'),
              'invoice_id' => $invoice_id,
              'quantity' => $request->input('quantity'),
              'price' => $request->input('price')
            ];



            Item::findOrFail($id)->update($FormData);

            return redirect(route('Index'));
    }

    public function delete($id)
    {
      Item::where('invoice_id', $id)->delete();
      Invoice::findOrFail($id)->delete();

      return redirect(route('Index'));
    }
}
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

      dd($request);

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

      // $data2 = [];

      $FormData = [
        'product_id' => $request->input('product_id'),
        'invoice_id' => $request->input('invoice_id'),
        'quantity' => $request->input('Quantity'),
        'price' => $request->input('price')
      ];

      Invoice::create($AdditionalData);

      Item::create($FormData);

      return response()->json(['message' => 'Form submitted successfully']);
    }
}
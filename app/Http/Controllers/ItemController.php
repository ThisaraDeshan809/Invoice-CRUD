<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
      $data = [
        'product_id' => $request->input('product_id'),
        'invoice_id' => $request->input('invoice_id'),
        'quantity' => $request->input('Quantity'),
        'price' => $request->input('price')
      ];

      return Item::create($data);
    }
}
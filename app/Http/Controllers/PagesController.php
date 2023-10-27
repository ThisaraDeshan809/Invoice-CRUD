<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
      return view('Invoice.index');
    }

    public function AddInvoice()
    {

      $users = User::all();
      $products = Product::all();

      return view('Invoice.AddInvoice' , compact('users' , 'products'));
    }

    public function EditInvoice()
    {
      return view('Invoice.EditInvoice');
    }
}

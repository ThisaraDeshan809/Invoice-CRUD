<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {

      $invoices = Invoice::all();

      return view('Invoice.index' , compact('invoices'));
    }

    public function AddInvoice()
    {

      $users = User::all();
      $products = Product::all();

      return view('Invoice.AddInvoice' , compact('users' , 'products'));
    }

    public function EditInvoice($id)
    {

      $users = User::all();
      $products = Product::all();
      $invoice = Invoice::findOrFail($id);

      return view('Invoice.EditInvoice', compact('users' , 'products','invoice'));
    }
}
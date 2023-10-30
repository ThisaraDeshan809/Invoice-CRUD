@extends('layouts.horizontalLayout')

@section('title', 'Invoice List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
@endsection

@section('page-script')

@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Invoice /</span> List
</h4>

<!-- Invoice List Table -->
<div class="card">
  <div class="card-datatable table-responsive">
    <table class="invoice-list-table table border-top">
      <thead>
        <tr>
          <th>#ID</th>
          <th>To</th>
          <th>Address</th>
          <th>Description</th>
          <th>Payment Type</th>
          <th>Date</th>
          <th>Due Date</th>
          <th>Total</th>
          <th class="text-truncate">Issued Date</th>
          <th class="cell-fit">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $invoices as $invoice )
        <tr>
          <td>{{$invoice->id}}</td>
          <td>{{$invoice->email}}</td>
          <td>{{$invoice->address}}</td>
          <td>{{$invoice->description}}</td>
          <td>{{$invoice->paymentType}}</td>
          <td>{{$invoice->date}}</td>
          <td>{{$invoice->due_date}}</td>
          <td>{{$invoice->total_price}}</td>
          <td>{{$invoice->created_at}}</td>
          <td>
            <a href="{{route('EditInvoice', $invoice->id)}}" class="btn btn-success btn-sm m-2">Edit Invoice</a>
            <a href="{{route('Invoices.delete', $invoice->id)}}" class="btn btn-danger btn-sm m-2">Delete Invoice</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

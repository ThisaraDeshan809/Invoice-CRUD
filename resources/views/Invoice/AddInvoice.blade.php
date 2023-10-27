@extends('layouts.horizontalLayout')

@section('title', 'Add - Invoice')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-invoice.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/offcanvas-send-invoice.js')}}"></script>
<script src="{{asset('assets/js/app-invoice-add.js')}}"></script>
<script src="{{asset('assets/js/invoice-item-price.js')}}"></script>
<script src="{{asset('assets/js/forms-extras.js')}}"></script>
{{-- <script src="{{asset('assets/js/invoice-submit.js')}}"></script> --}}
@endsection

@section('content')

<div class="row invoice-add">
  <!-- Invoice Add-->
    <div class="col-lg-9 col-12 mb-lg-0 mb-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
          <div class="row m-sm-4 m-0">
            <div class="col-md-7 mb-md-0 mb-4 ps-0">
              <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                @include('_partials.macros',["height"=>20,"withbg"=>''])
                <span class="app-brand-text fw-bold fs-4">
                  {{ config('variables.templateName') }}
                </span>
              </div>
              <p class="mb-2">CodeFusion Technology PTE LTD</p>
              <p class="mb-2">Singapore</p>
              <p class="mb-3">+1 (123) 456 7891, +44 (876) 543 2198</p>
            </div>


            <div class="col-md-5">
              <dl class="row mb-2">
                <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                  <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                </dt>
                <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                  <div class="input-group input-group-merge disabled w-px-150">
                    <span class="input-group-text">#</span>
                    <input type="text" name="invoice_id" disabled class="form-control" placeholder="0001" value="1" id="invoiceId" />
                  </div>
                </dd>
                <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                  <span class="fw-normal">Date:</span>
                </dt>
                <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                  <input type="text" name="date" id="date" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" />
                </dd>
                <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                  <span class="fw-normal">Due Date:</span>
                </dt>
                <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                  <input type="text" name="dueDate" id="dueDate" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" />
                </dd>
              </dl>
            </div>
          </div>

          <hr class="my-3 mx-n4" />

          <div class="row p-sm-4 p-0">
            <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
              <h6 class="mb-4">Invoice To:</h6>
              <select class="form-select mt-1" name="invoiceTo" id="invoiceTo" required aria-label="Default select example">
                <option selected>Select Customer</option>
                @foreach ($users as $user )
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>

              <select class="form-select mt-1" name="invoiceToAddress" id="invoiceToAddress" required aria-label="Default select example">
                <option selected>Select Customer Address</option>
                @foreach ($users as $user )
                <option value="{{$user->address}}">{{$user->address}}</option>
                @endforeach
              </select>

              <select class="form-select mt-1" name="invoiceToEmail" id="invoiceToEmail" required aria-label="Default select example">
                <option selected>Select Customer Email</option>
                @foreach ($users as $user )
                <option value="{{$user->email}}">{{$user->email}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 col-sm-7">
              <h6 class="mb-4">Bill To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-4">Total Due:</td>
                    <td><strong>$12,110.55</strong></td>
                  </tr>
                  <tr>
                    <td class="pe-4">Bank name:</td>
                    <td>American Bank</td>
                  </tr>
                  <tr>
                    <td class="pe-4">Country:</td>
                    <td>United States</td>
                  </tr>
                  <tr>
                    <td class="pe-4">IBAN:</td>
                    <td>ETD95476213874685</td>
                  </tr>
                  <tr>
                    <td class="pe-4">SWIFT code:</td>
                    <td>BR91905</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <hr class="my-3 mx-n4" />
  <!-- Form Repeater -->

  <div class="col-12">
    <div class="card">
      <h5 class="card-header">Add Items</h5>
      <div class="card-body">
        <form class="form-repeater" id="itemForm">
          @csrf
          <input type="hidden" name="invoice_id" id="invoice_id">
          <div data-repeater-list="group-a">
            <div data-repeater-item class="repeter-item">
              <div class="row">
                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                  <label class="form-label" for="form-repeater-1-3">Gender</label>
                  <select id="product_id" name="product_id" class="form-select">
                    @foreach ( $products as $product )
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                  <label class="form-label" for="form-repeater-1-1">item Cost</label>
                  <input type="text" id="form-repeater-1-1" name="cost" id="cost" class="form-control" placeholder="$ 0.0" />
                </div>
                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                  <label class="form-label" for="form-repeater-1-2">Quantity</label>
                  <input type="number" id="Quantity" name="Quantity" class="form-control" placeholder="00" />
                </div>
                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                  <label class="form-label" for="form-repeater-1-2">Total Price</label>
                  <input type="text" id="price" name="price" class="form-control item-data" placeholder="$ 0.0" />
                </div>
                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                  <button class="btn btn-label-danger mt-4" data-repeater-delete>
                    <i class="ti ti-x ti-xs me-1"></i>
                    <span class="align-middle">Delete</span>
                  </button>
                </div>
              </div>
              <hr>
            </div>
          </div>
          <div class="mb-0">
            <button class="btn btn-primary" data-repeater-create>
              <i class="ti ti-plus me-1"></i>
              <span class="align-middle">Add Item</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
          <hr class="my-3 mx-n4" />

          <div class="row p-0 p-sm-4">
            <div class="col-md-6 d-flex justify-content-end">
              <div class="invoice-calculations">
                <div class="d-flex justify-content-between mb-2">
                  <span class="w-px-100">Subtotal:</span>
                  <span class="input-group-text">$</span>
                  <input type="number" id="totalSum" class="form-control" disabled>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="w-px-100">Discount:</span>
                  <span class="input-group-text">$</span>
                  <input type="number" placeholder="0.0" class="form-control">
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="w-px-100">Tax:</span>
                  <span class="input-group-text">$</span>
                  <input type="number" placeholder="0.0" class="form-control">
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                  <span class="w-px-100">Total:</span>
                  <span class="input-group-text">$</span>
                  <input type="number" id="totalSum2" name="totalSum2" class="form-control" disabled>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-3 mx-n4" />

          <div class="row px-0 px-sm-4">
            <div class="col-12">
              <div class="mb-3">
                <label for="note" class="form-label fw-semibold">Note:</label>
                <textarea class="form-control" rows="2" name="description" id="description" placeholder="Invoice note"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  <!-- /Invoice Add-->

  <!-- Invoice Actions -->
  <div class="col-lg-3 col-12 invoice-actions">
    <div class="card mb-4">
      <div class="card-body">
        <button class="btn btn-primary d-grid w-100 mb-2" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-1"></i>Send Invoice</span>
        </button>
        <a href="{{url('app/invoice/preview')}}" class="btn btn-buy-now d-grid w-100 mb-2">Preview</a>
        <button id="submitData" type="button" class="btn btn-success d-grid w-100">Save</button>
      </div>
    </div>
    <div>
      <p class="mb-2">Accept payments via</p>
      <select name="paymentType" id="paymentType" class="form-select mb-4">
        <option value="Bank Account">Bank Account</option>
        <option value="Paypal">Paypal</option>
        <option value="Card">Credit/Debit Card</option>
        <option value="UPI Transfer">UPI Transfer</option>
      </select>
      <div class="d-flex justify-content-between mb-2">
        <label for="payment-terms" class="mb-0">Payment Terms</label>
        <label class="switch switch-primary me-0">
          <input type="checkbox" class="switch-input" id="payment-terms" checked />
          <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
          </span>
          <span class="switch-label"></span>
        </label>
      </div>
      <div class="d-flex justify-content-between mb-2">
        <label for="client-notes" class="mb-0">Client Notes</label>
        <label class="switch switch-primary me-0">
          <input type="checkbox" class="switch-input" id="client-notes" />
          <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
          </span>
          <span class="switch-label"></span>
        </label>
      </div>
      <div class="d-flex justify-content-between">
        <label for="payment-stub" class="mb-0">Payment Stub</label>
        <label class="switch switch-primary me-0">
          <input type="checkbox" class="switch-input" id="payment-stub" />
          <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
          </span>
          <span class="switch-label"></span>
        </label>
      </div>
    </div>
  </div>
  <!-- /Invoice Actions -->
</div>

<script>
$(document).ready(function () {
  $('#submitData').click(function (e) {
    e.preventDefault();

    var formDataObj = new FormData();
    // var invoiceId = 1;

    // Iterate through the form repeater items
    $('[data-repeater-item]').each(function (index, item) {
      var product_id = $(item).find('[name="product_id"]').val();
      var quantity = $(item).find('[name="Quantity"]').val();
      var price = $(item).find('[name="price"]').val();

      // Append item data to the FormData object
      formDataObj.append('items[' + index + '][product_id]', product_id);
      formDataObj.append('items[' + index + '][quantity]', quantity);
      formDataObj.append('items[' + index + '][price]', price);
    });

    // Append additional data
    formDataObj.append('product_id', $('#product_id').val());
    // formDataObj.append('invoice_id', invoiceId);
    formDataObj.append('quantity', $('#Quantity').val());
    formDataObj.append('price', $('#price').val());
    formDataObj.append('date', $('#date').val());
    formDataObj.append('due_date', $('#dueDate').val());
    formDataObj.append('user_id', $('#invoiceTo').val());
    formDataObj.append('address', $('#invoiceToAddress').val());
    formDataObj.append('email', $('#invoiceToEmail').val());
    formDataObj.append('total_price', $('#totalSum2').val());
    formDataObj.append('description', $('#description').val());
    formDataObj.append('paymentType', $('#paymentType').val());

    // Now you can use formDataObj to send the data using AJAX
    $.ajax({
      url: '{{ route('Invoices.store') }}',
      method: 'POST',
      data: formDataObj,
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        // Handle the response from the server if needed
        console.log(response);
      },
      error: function (xhr, status, error) {
        console.error('Error saving data in Invoices table:', error);
      }
    });
  });
});

</script>

<!-- Offcanvas -->
@include('_partials/_offcanvas/offcanvas-send-invoice')
<!-- /Offcanvas -->
@endsection

@extends('layouts.default')
@section('title', 'Order Entry')
@section('content')
    <div class="page-header">
        <h4 class="page-title">Order Entry</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="col-md-4">
                        <div class="card-body">
                            <form action="{{ route('order.store') }}" method="POST" id="form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Order ID</label>
                                    <input type="text" name="id" class="form-control" value="{{ $prod_id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Order Date</label>
                                    <input type="date" name="order_date" class="form-control" value="{{ old('order_date') }}" id="order_date">
                                        <p class="text-danger">{{ $errors->first('order_date') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" id="customer_name">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Total Price</label>
                                    <input type="number" name="subtotal" class="form-control" value="{{ old('subtotal') }}" id="subtotal">
                                    <p class="text-danger">{{ $errors->first('subtotal') }}</p>
                                </div>
                                <div class="form-group">
                                    <td> 
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Add Item
                                            </a>
                                        <button class="btn btn-success">Simpan</button>
                                    </td>
                                </div>
                            </form>
                        </div>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>{{ number_format($row->price) }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>{{ number_format($row->subtotal) }}</td>
                                        <td>
                                            @if( Auth::user()->type == 'admin' )
                                                <div class="form-button-action">
                                                    <form action="{{ route('order.deleteDetail', $row->id) }}" method="GET" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-link btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $no++ ;?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('order.addproduct') }}" method="POST">
            {{ csrf_field() }}
        <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Product ID</label>
                  {{-- <input type="text" class="form-control" name="product_id" id="product_id"> --}}
                  <select name="product_id" class="form-control" id="prodId" required>
                    <option value="">--Pilih--</option>
                        @foreach ($product as $data)
                             <option value="{{$data->id}}">{{$data->id}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" disabled>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Unit Price</label>
                    <input type="text" class="form-control" id="price" disabled>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">QTY</label>
                    <input type="text" class="form-control" name="qty" id="qty" required>
                </div>
                {{-- <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Sub Total</label>
                    <input type="text" class="form-control" name="subtotal" id="subtotal" disabled>
                </div> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script >
        $(document).ready(function() {
            $("#form").validate({
                rules: {
                    order_date: "required",
                    customer_name: "required",
                    subtotal: "required",
                }
            });
        });
        @if(Session::has('message_alert'))  
            swal(
                'Success!',
                '{{ Session::get("message_alert") }}',
                'success'
            );
        @endif

        $(document).ready(function() {
            $('#basic-datatables').DataTable({
            });
	    })

        $('#prodId').change(function() {
            var id = $(this).val();
            var url = '{{ route("product.getAll", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        $('#product_name').val(response.product_name);
                        $('#price').val(response.price);
                    }
                }
            });
        });
    </script>
@endpush
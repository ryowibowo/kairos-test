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
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Order ID</label>
                                    <input type="text" name="id" class="form-control" value="{{ old('product_name') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="name">Order Date</label>
                                    <input type="date" name="order_date" class="form-control" value="{{ old('order_date') }}">
                                        <p class="text-danger">{{ $errors->first('order_date') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
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
                                        <td>{{ $row->price }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>{{ $row->subtotal }}</td>
                                        <td>
                                            @if( Auth::user()->type == 'admin' )
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit Task">
                                                        <a href="{{ route('product.edit', $row->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </button>
                                                    <form action="{{ route('product.destroy', $row->id) }}" method="GET" class="d-inline">
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
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
        <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Recipient:</label>
                  <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Message:</label>
                  <textarea class="form-control" id="message-text"></textarea>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@push('after-script')
    <script >
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

    </script>
@endpush
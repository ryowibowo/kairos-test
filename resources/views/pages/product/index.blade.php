@extends('layouts.default')
@section('title', 'Master Product')
@section('content')
    <div class="page-header">
        <h4 class="page-title">Master Product</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-right">
                            @if( Auth::user()->type == 'admin' )
                                <a href="{{ route('product.create') }}">
                                    <button class="btn btn-success btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    New Master Product
                                    </button>
                                </a>
                            @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
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
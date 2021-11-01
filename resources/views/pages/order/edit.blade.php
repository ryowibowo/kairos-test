@extends('layouts.default')
@section('content')
    <div class="page-header">
        <h4 class="page-title">Edit</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('order.update', $item->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="order_date">Date Order</label>
                            <input type="date" name="order_date" class="form-control" value="{{ old('order_date') ? old('order_date') : $item->order_date }}">
                                <p class="text-danger">{{ $errors->first('order_date') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') ? old('customer_name') : $item->customer_name }}">
                            <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                        </div>
                        
                        <div class="form-group">
                            <td> 
                                <a href="{{ route('order') }}" class="btn btn-danger">Kembali
                                    </a>
                                <button class="btn btn-primary">Simpan</button>
                             </td>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


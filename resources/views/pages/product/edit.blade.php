@extends('layouts.default')
@section('content')
    <div class="page-header">
        <h4 class="page-title">Edit Master</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product.update', $item->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') ? old('product_name') : $item->product_name }}">
                                <p class="text-danger">{{ $errors->first('product_name') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price') ? old('price') : $item->price }}">
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                        </div>
        
                        
                        <div class="form-group">
                            <td> 
                                <a href="{{ route('product') }}" class="btn btn-danger">Kembali
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


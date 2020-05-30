@extends('layouts.main')

@section('title')
Edit Product
@endsection

@section("breadcrumb")
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item">Products</li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')
<div class="card">
    <form id="form-product" method="POST" action="{{route('products.update', $product->id)}}">
        <div class="card-header">
            Edit Product
        </div>
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_code" class="required">Product Code</label>
                <input type="text" class="form-control @error('product_code') is-invalid @enderror" name="product_code" placeholder="Please entry a product code" value="{{ $product->product_code }}">
                @error('product_code')
                <label class="invalid-feedback" for="product_code">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_name" class="required">Product Name</label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" placeholder="Please entry a product name" value="{{ $product->product_name }}">
                @error('product_name')
                <label class="invalid-feedback" for="product_name">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="qty" class="required">Qty</label>
                <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" placeholder="Please entry a product qty" value="{{ $product->qty }}">
                @error('qty')
                <label class="invalid-feedback" for="qty">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="required">Price</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Please entry a product price" value="{{ $product->price }}">
                @error('price')
                <label class="invalid-feedback" for="price">{{$message}}</label>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Update</button>
            <button class="btn btn-danger" type="button"
                onclick="window.location.href='{{route('products.index')}}'">Batal</button>
        </div>
    </form>
</div>
@endsection

@section("jsLibrary")
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
@endsection

@section("scriptJS")
<script>
    $('#form-product').validate({
        rules: {
            product_code: {
                required: true
            },
            product_name: {
                required: true
            },
            qty: {
                required: true
            },
            price: {
                required: true
            },
        },
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.insertAfter(element);
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        highlight: function (element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
</script>
@endsection

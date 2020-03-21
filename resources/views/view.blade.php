@extends('parent')

@section('main')
    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Product List</a>
        </div>
        @for($i= 0; $i < count($images); $i++)
             <img src="{{ URL::to('/') }}/images/{{ json_decode($product->product_image)[$i] }}" width="200px" height="200px" class="img-thumbnail">
        @endfor

{{--        @foreach($images as $image)--}}
{{--            <img src="{{ URL::to('/') }}/images/{{ json_decode($product->product_image)[$image] }}" width="200px" height="200px" class="img-thumbnail">--}}
{{--        @endforeach--}}
        <h3>Product Name - {{ $product->product_name }}</h3>
        <h3>Product Price - {{ $product->product_price }}</h3>
        <h3>Category - {{ $product->category->name }}</h3>
    </div>
@endsection

@extends('parent')

@section('main')
    <a href="{{ route('products.index') }}">Product List</a><br>
    <a href="{{ route('category.index') }}">Category List</a>
@endsection




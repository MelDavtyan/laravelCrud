
@extends('parent')
<style>
    .img_wrp {
        display: inline-block;
        position: relative;
    }
    .close {
        background: rgba(255,255,255,0.8);
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 0;
    }
</style>
@section('main')

    <div align="right">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Product List</a>
    </div>
    <div class="mx-auto my-0 my-sm-10 my-lg-4 p-3 col-md-8">
        <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="product_name" value="{{ $product->product_name }}">
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" name="product_price" class="form-control" id="product_price" value="{{ $product->product_price }}">
            </div>
            <div class="form-group">
                <input type="file" multiple accept="image/*" name="product_image[]" class="form-control-file" id="product_image">
                @for($i= 0; $i < count($images); $i++)
                    <div class="img_wrp">
                        <img src="{{ URL::to('/') }}/images/{{ json_decode($product->product_image)[$i] }}" class="img-thumbnail" width="100">
                        <div class="close" onclick="deleteImage(event,'{{ $product->id }}','{{ json_decode($product->product_image)[$i] }}',this)">
                            &times;
                        </div>
                    </div>
                @endfor
                <input type="hidden" name="hidden_image" id="hidden_image" value="{{ $product->product_image }}">
            </div>

            <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id[]" id="category_id" class="form-control selectpicker" multiple>
                    @foreach($categories as $category)
                        @if(in_array($category->id,$productCategoryIds))
                            <option value="{{ $category->id }}" selected="true">{{$category->name}}</option>
                        @else
                        <option name="category_name" value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary input-lg" value="Update">
            </div>
        </form>
    </div>
@endsection

@extends('parent')

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
                    <img src="{{ URL::to('/') }}/images/{{ json_decode($product->product_image)[$i] }}" class="img-thumbnail" width="100">
                @endfor
                <input type="hidden" name="hidden_image" value="{{ $product->product_image }}">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select type="text" name="category_id" class="form-control" id="category_id">
                    @foreach($categories as $category)
                        <option name="category_name" value="{{ $category->id }}" {{$category->id == $product->category_id ? "selected" : ""}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="editBtn" class="btn btn-primary input-lg" value="Update">
            </div>
        </form>
    </div>

@endsection

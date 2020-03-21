@extends('parent')

@section('main')
    <?php // TODO add opportunity to select multiple categories for one product ?>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="right mx-auto my-0 my-sm-10 my-lg-4 p-3">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Product List</a>
    </div>

    <div class="mx-auto my-0 my-sm-10 my-lg-4 p-3 col-md-8">
        <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Product Name">
            </div>

            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Product Price">
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select type="text" name="category_id" class="form-control" id="category_id">
                    <?php // TODO add default select option with value 0 ?>
                    @foreach($categories as $category)
                        <option name="category_name" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="file" multiple accept="image/*" name="product_image[]" class="form-control-file" id="product_image">
            </div>
            <button type="submit" class="btn btn-primary">Add product</button>
        </form>
    </div>
@endsection

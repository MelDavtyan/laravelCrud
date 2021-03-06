<?php use App\Category; ?>
@extends('parent')
<style>
    .tdCustom{
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 30px!important;
    }
    td>form{
        margin: 0!important;
    }
</style>

@section('main')

    <div class="right">
        <div class="mx-auto my-2 my-sm-3 my-lg-4 p-3">
            <a href="{{ route('products.create') }}" class="btn btn-success">Add new Product</a>
        </div>
    </div>
    <div class="left">
        <div class="mx-auto my-2 my-sm-3 my-lg-4 p-3">
            <a href="{{ route('category.index') }}" class="btn btn-dark">Category List</a>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-dark">
        <tr>
            <th width="10%">Product Image</th>
            <th width="25%">Product Name</th>
            <th width="15%">Product Price</th>
            <th width="20%">Category</th>
            <th width="40%">Action</th>
        </tr>
        @foreach($products as $product)
                <tr>
                    <td>
                        <?php $img = json_decode($product->product_image); ?>
                        <img src="{{URL::to('/')}}/images/{{ is_array($img) && !empty($img) ? $img[0] : 'noimage.gif' }}" class="img-thumbnail" width="75">
                    </td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->product_price}}</td>
                    <td>  |
                        @foreach(json_decode($product->category_id) as $id)
                            <?php $cat = Category::find($id); echo $cat->name . " | ";?>
                        @endforeach
                    </td>
                    <td class="tdCustom">
                        <a href="{{ route('products.show',$product->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('products.edit',$product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy',$product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
        @endforeach
    </table>
    {!! $products->links() !!}
@endsection

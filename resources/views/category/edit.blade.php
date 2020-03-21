@extends('category.layout')


@section('content')
    <div class="left">
        <div class="mx-auto my-2 my-sm-3 my-lg-4 p-3">
            <a href="{{ route('category.index') }}" class="btn btn-dark">Category List</a>
        </div>
    </div>

<form action="{{ route('category.update',$category->id) }}" method="post" role="form">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}"><br>
    </div>

    <div class="form-group">
        <label for="parent_id">Category</label>
        <select type="text" name="parent_id" class="form-control" id="parent_id">
            @foreach($categories as $categoryForParent)
                <option name="category_name" value="{{ $categoryForParent->id }}" {{ $categoryForParent->id == $category->parent_id ? "selected" : "" }}>{{ $categoryForParent->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection

@extends('category.layout')
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

@section('content')



    <div class="container">
        <div class="mx-auto p-3">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Product List</a>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <main class="col-md-8" style="margin-top: 30px">

            <form action="{{ route('category.store') }}" method="post" role="form">
                @csrf
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Category name"><br>
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent Category</label>
                    <select type="text" name="parent_id" class="form-control" id="parent_id">
                            <option value="0">==SELECT==</option>
                        @foreach($categories as $category)
                            <option name="category_name" value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </main>

    <br><br>
        <h3 style="text-decoration: none;">Categories List</h3><br>


            @if(!empty($categories))
                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>Category Name</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td><a href="{{ route('category.show',$category->id,$category->parent_id) }}">{{ $category->name }}</a> </td>
                            <td class="tdCustom">
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('category.destroy',$category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <li>No Category</li>
                        @endforelse
                        </tbody>
                    </table>
                </div>


            @endif

@endsection

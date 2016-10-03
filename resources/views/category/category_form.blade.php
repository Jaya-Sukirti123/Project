@extends('layout.dashboard')
@section('content')
    <h2>CATEGORY FORM</h2>
    @include('layout.partials.messages')
        <form action="{{ $category->id ? route('categories.update', $category->id) : route('categories.store') }}" method="post">
            {{method_field($category->id ? 'PATCH' : 'POST')}}
            {{csrf_field()}}
            <div class="form-group">
                <label class="control-label col-xs-3" for="title">Category Name:</label>
                <input type="text" name="category_name" class="form-control" placeholder="Category name" value="{{$category->category_name}}" >
            </div>
             <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('categories.index')}}" class="btn btn-default"><button type="button">VIEW CATEGORIES</button></a>
            </div>
        </form>
@endsection        
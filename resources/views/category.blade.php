@extends('layout.dashboard')
@section('content')
@include('layout.partials.messages');
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CATEGORY FORM</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
        <h2>FORM</h2>
        <form action="{{ $category->id ? route('Category.update', $category->id) : route('Category.store') }}" method="post">
            {{method_field($category->id ? 'PATCH' : 'POST')}}
            {{csrf_field()}}
            <div class="form-group">
                <label class="control-label col-xs-3" for="title">Category Name:</label>
                <input type="text" name="category_name" class="form-control" placeholder="Category name" value="{{$category->category_name}}" >
            </div>
             <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('Category.index')}}" class="btn btn-default"><button type="button">Back to project</button></a>
            </div>
        </form>
        </div>
    </body>
</html>
@endsection        
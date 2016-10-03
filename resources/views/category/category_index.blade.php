@extends('layout.dashboard')   
@section('content')
    <h2>CATEGORY FORM</h2>
    @include('layout.partials.messages')
    <form action="{{ route('categories.search')}}" method="GET" >
        <div class="form-group">
            <label class="control-label col-xs-3" for="search">Search Here:</label>
            <input type="text" class="form-control" name="search" placeholder="search by category...." value="{!! $request->get('search') !!}">
        </div>
        <div class="col-md-12">
            <input type='submit' class="btn btn-default" value="SEARCH">
        </div>
    </form>
    <h2>CATEGORY LIST</h2>
    @foreach ($categories as $category)  
        <ul>
            <li>
                <h4>Category Name:{{$category->category_name}}</h4>
                    <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <input type='submit' class="btn btn-danger" value="DELETE">
                    </form>
            </li>
        </ul>
    @endforeach
    {!! $categories->links() !!}
    @endsection    
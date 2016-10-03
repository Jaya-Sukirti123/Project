 @include('layout.partials.messages')
<!DOCTYPEhtml>
<html>
    <head>
        <title>
            Category List
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h2>CATEGORY FORM</h2>
        <form action="{{ route('Category.search')}}" method="GET" >
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
                   
                    <form action="{{ route('Category.destroy', $category->id)}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <input type='submit' class="btn btn-danger" value="DELETE">
                    </form>
                </li>
            </ul>
        @endforeach
        
       {!! $categories->links() !!}
        </div>
    </body>
</html>
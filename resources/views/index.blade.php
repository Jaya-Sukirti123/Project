 @include('layout.partials.messages')
<!DOCTYPEhtml>
<html>
    <head>
        <title>
            Project List
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h2>SEARCH FORM</h2>
        <form action="{{ route('Projects.search')}}" method="GET" >
            <div class="form-group">
                <label class="control-label col-xs-3" for="search">Search Here:</label>
                <input type="text" class="form-control" name="search" placeholder="search by title,description,reference...." value="{!! $request->get('search') !!}">
            </div>
            <div class="form-group">
                <label class="control-label col-xs-9">Priority:</label>
                <select class="form-control" name="priority">
                     <option value="">-select-</option>
                    @for($i=1; $i<=10; $i++)
                    <option value="{!! $i !!}" {!! $request->get('priority') == $i ? 'selected' : '' !!}>{!! $i !!}</option>
                    @endfor    
                </select>
            </div>
            <div class="col-md-12">
                <input type='submit' class="btn btn-default" value="SEARCH">
            </div>
        </form>
        <h2>PROJECT LIST</h2>
       
        @foreach ($projects as $project)  
            <ul>
                <li>
                    <h4>Title:{{$project->title}}</h4>
                    <h4>Description:{{$project->description}}</h4>
                    <h4>Timer:{{$project->timer}}</h4>
                    <h4>Reference To:{{$project->reference_to}}</h4>
                    <h4>Priority:{{$project->priority}}</h4>
                    <h4>Category:{{$project->category}}</h4>
                    <form action="{{ route('Projects.destroy', $project->id)}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <input type='submit' class="btn btn-danger" value="DELETE">
                    </form>
                </li>
            </ul>
        @endforeach
        
        {!! $projects->links() !!}
        </div>
    </body>
</html>
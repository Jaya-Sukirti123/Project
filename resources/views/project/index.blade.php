@extends('layout.dashboard')  
@section('content')
<h2>SEARCH FORM</h2>
        <form action="{{ route('projects.search')}}" method="GET" >
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
        @include('layout.partials.messages')
        @foreach ($projects as $project)  
            <ul>
                <li>
                    <h4>Title:{{$project->title}}</h4>
                    <h4>Description:{{$project->description}}</h4>
                    <h4>Timer:{{$project->timer}}</h4>
                    <h4>Reference To:{{$project->reference_to}}</h4>
                    <h4>Priority:{{$project->priority}}</h4>
                    <h4>Category:{{$project->category}}</h4>
                    <form action="{{ route('projects.destroy', $project->id)}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <input type='submit' class="btn btn-danger" value="DELETE">
                    </form>
                </li>
            </ul>
        @endforeach
        {!! $projects->links() !!}
    @endsection

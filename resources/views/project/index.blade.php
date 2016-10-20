@extends('layout.dashboard')  
@section('content')
<form action="{{ route('project.logout')}}" method="get">
    {{method_field('GET')}}
    {{csrf_field()}}
    <button type="submit" class="btn btn-default pull-right btn-sm"><span class="glyphicon glyphicon-off"></span>LOGOUT</button>
</form>
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
                <button type='submit' class="btn btn-default"><span class="glyphicon glyphicon-search"></span>SEARCH</button>
            </div>
        </form>
        <h2>PROJECT LIST</h2>
        @include('layout.partials.messages')
        @foreach ($projects as $project)  
            <ul>
                <li>
                    <form action="{{ route('projects.edit', $project->id)}}" method="get" required>
                        {{method_field('GET')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-info pull-right btn-sm"><span class="glyphicon glyphicon-edit"></span>UPDATE</button>
                    </form>
                    <form action="{{ route('projects.destroy', $project->id)}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger pull-right btn-sm"><span class="glyphicon glyphicon-trash"></span>REMOVE</button>
                    </form>
                    @if($project->status == 'completed') 
                        <h4><strike>Title: {{$project->title}}</strike></h4>
                        <h4><strike>Description: {{$project->description}}</strike></h4>
                        <h4><strike>Timer: {{$project->timer}}</strike></h4>
                        <h4><strike>Reference To: {{$project->reference_to}}</strike></h4>
                        <h4><strike>Priority: {{$project->priority}}</strike></h4>
                        <h4><strike>Category: {{$project->category}}</strike></h4>
                        <h4><strike>Status: {{$project->status}}</strike></h4>
                    @elseif($project->status == 'uncompleted')
                        <h4>Title: {{$project->title}}</h4>
                        <h4>Description: {{$project->description}}</h4>
                        <h4>Timer: {{$project->timer}}</h4>
                        <h4>Reference To: {{$project->reference_to}}</h4>
                        <h4>Priority: {{$project->priority}}</h4>
                        <h4>Category: {{$project->category}}</h4> 
                        <h4>Status: {{$project->status}}</h4>
                    @endif
                    <input type="checkbox" name="checkbox" id="checkbox" 
                           onclick="window.location = '{!! ($project->status == 'uncompleted') ? route("project.cancel", $project->id) : route("project.undo", $project->id) !!}'"><strong><mark>MARK COMPLETED/UNDO</mark></strong>
                </li>
            </ul>
        @endforeach
        <form action="{{ route('projects.create', $project->id)}}" method="get" required>
            {{method_field('GET')}}
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary pull-right btn-sm"><span class="glyphicon glyphicon-plus-sign"></span>ADD NEW RECORD</button>
        </form>
        {!! $projects->links() !!}
    @endsection
   
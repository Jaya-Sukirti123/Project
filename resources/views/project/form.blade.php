@extends('layout.dashboard')
@section('content')
    <h2>PROJECT FORM</h2>
        @include('layout.partials.messages')
        <form action="{{ $project->id ? route('projects.update', $project->id) : route('projects.store') }}" method="post">
            {{method_field($project->id ? 'PATCH' : 'POST')}}
            {{csrf_field()}}
            <div class="form-group">
                <label class="control-label col-xs-3" for="title">Title:</label>
                <input type="text" name="title" class="form-control" placeholder="title" value="{{$project->title}}" >
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="description">Description:</label>
                <textarea name="description"  class="form-control" placeholder="Add Description Here...">{{$project->description}}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="timer">Timer:</label>
                <input type="text" name="timer" class="form-control" placeholder="timer" value="{{$project->timer}}" >
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="reference">Reference To:</label>
                <input type="text" name="reference_to" class="form-control" placeholder="reference to" value="{{$project->reference_to}}" >
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Priority:</label>
                <select class="form-control" name="priority">
                    <option value="">-select-</option>
                    <option value="1" {{$project->priority == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{$project->priority == 1 ? 'selected' : '' }}>2</option>
                    <option value="3" {{$project->priority == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{$project->priority == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{$project->priority == 5 ? 'selected' : '' }}>5</option>
                    <option value="6" {{$project->priority == 6 ? 'selected' : '' }}>6</option>
                    <option value="7" {{$project->priority == 7 ? 'selected' : '' }}>7</option>
                    <option value="8" {{$project->priority == 8 ? 'selected' : '' }}>8</option>
                    <option value="9" {{$project->priority == 9 ? 'selected' : '' }}>9</option>
                    <option value="10" {{$project->priority == 10 ? 'selected' : '' }}>10</option>    
                </select>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Category:</label>
                    <input type="text" name="category" class="form-control" placeholder="category" value="{{$project->category}}" > 
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('projects.index')}}" class="btn btn-default"><button type="button">Back to project</button></a>
            </div>
        </form>
@endsection


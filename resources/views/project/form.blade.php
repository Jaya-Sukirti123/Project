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
                    @for($i=1; $i<=10; $i++)
                        <option value="{{$i}}" {{ $project->priority == $i ? 'selected' : '' }}>{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Category:</label>
                <select class="form-control" name="category[]" multiple>
                        @php($projectCategoryIds = $project->categories->pluck('category_name', 'id'))
                        dd($projectCategoryIds);
                        @foreach($categories as $id => $category_name)
                            <option value="{{$id}}" {{ $projectCategoryIds->has($id) ? 'selected' : '' }}>{{$category_name}}</option> 
                        @endforeach 
                </select>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('projects.index')}}" class="btn btn-default"><button type="button">Back to project</button></a>
            </div>
        </form>
@endsection


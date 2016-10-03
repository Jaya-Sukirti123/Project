<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Model\Project;
use Illuminate\Http\Request;
use function redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers;
 use App\Jobs\SearchProject;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects=Project::paginate(10);
        
        return view ('project\index', compact('projects', 'request'));
    }
    
    public function search(Request $request)
    {
        $projects=$this->dispatch(new SearchProject());
        
        return view('project\index', compact('projects', 'request'));
    }

    public function create()
    {
        $project= new Project();
        return view('project\form', compact('project'));
    }
    
    public function store(CreateProjectRequest $request)
    {
        Project::create($request->all());
        return redirect()->back()->with('message', 'Submitted Successfully');
    }
    
     public function edit($id, Request $request)
    { 
       
        $project = Project::find($id);
        return view('project\form', compact('project'));
    }
    
    public function update($id, Request $request)
    {  
        if ($project = Project::find($id)) {
            $project->update($request->toArray());
            return redirect()->back()
                ->withMessage('successfully updated');
       }
       return redirect()->back()->withErrors('unable to update');
    }
    
    public function destroy($id, Request $request)
    {
        if($project=Project::find($id)) {
            $project->delete();
            return redirect()->back()->withMessage('Successfully Deleted');
        }
        return redirect()->back()->withErrors('unable to delete');
    }
    
    
}
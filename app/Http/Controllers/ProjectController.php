<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Jobs\SearchProject;
use App\model\Category;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function redirect;
use function view;
//use DB;

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
        $categories =Category::pluck('category_name', 'id');
        return view('project\form', compact('project', 'categories'));
    }
    
    public function store(CreateProjectRequest $request)
    {
        return DB::transaction( function() use($request) {
               
                if($projects = Project::create($request->all()))
                    {
                        $projects->categories()->sync($request->get('category'));
                    }
                return redirect()->back()->with('message', 'Submitted Successfully');          
        });
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
<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Jobs\SearchProject;
use App\model\Category;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function redirect;
use function view;
//use DB;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $categories = Category::pluck('category_name','id');
        return view('project\form', compact('project', 'categories'));
    }
    
    public function update($id, Request $request)
    {  
        return DB::transaction( function() use($id, $request) {
            if($projects = Project::find($id))
                {
                    $projects->categories()->sync($request->get('category'));
                    $projects->update($request->toArray());
                }
            return redirect()->back()->with('message', 'updated Successfully');  
        });
    }
    
    public function destroy($id, Request $request)
    {
        if($project=Project::find($id)) {
            $project->delete();
            return redirect()->back()->withMessage('Successfully Deleted');
        }
        return redirect()->back()->withErrors('unable to delete');
    }
    
    public function cancel($id, Request $request) 
        {
            /**
            * 1. Get the project.
            * 2. Update database status to completed.
            * 3. if successfully then redirect.
            * 4. else redirect and throw error.
            */
            if ($project = Project::find($id)) {
                $projects = $project->where('id', 'LIKE', $request->id)
                                    ->update(['status' => 'completed']);
                $status = Project::where('status', 'completed')->value('status');    
                //dd($status);
                return redirect()->back()
                                ->withMessage('successfully updated status as completed')
                                ->withStatus($status);
            }
            return redirect()->back()->withErrors('unable to update status');
        }
        
        public function undo($id, Request $request) 
        {
            /**
            * 1. Get the project.
            * 2. Update database status to uncompleted.
            * 3. if successfully then redirect.
            * 4. else redirect and throw error.
            */
            if ($project = Project::find($id)) {
                $projects = $project->where('id', 'LIKE', $request->id)
                                    ->update(['status' => 'uncompleted']);
                $status = Project::where('status', 'uncompleted')->value('status');    
                //dd($status);
                return redirect()->back()
                                ->withMessage('successfully updated status as uncompleted')
                                ->withStatus($status);
            }
            return redirect()->back()->withErrors('unable to update status');
        } 
}   

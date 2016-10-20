<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Jobs\SearchCategory;
use App\model\Category;
use Illuminate\Http\Request;
use function redirect;
use function view;

class CategoryController extends Controller
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
        $categories=Category::paginate(5);
        return view ('category\category_index', compact('categories', 'request'));
    } 
    
    public function search(Request $request)
    {
        $categories=$this->dispatch(new SearchCategory());
        return view('category\category_index', compact('categories', 'request'));
    }
    
    public function create()
    {
        $category= new Category();
        return view('category\category_form', compact('category'));
    }
    
    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->back()->with('message', 'Submitted Successfully');
    }
    
    public function edit($id, Request $request)
    { 
        $category = Category::find($id);
        return view('category\category_form', compact('category'));
    }
    
    public function update($id, Request $request)
    {  
        if ($category = Category::find($id)) {
            $category->update($request->toArray());
            return redirect()->back()->withMessage('successfully updated');
       }
       return redirect()->back()->withErrors('unable to update');
    }
    
    public function destroy($id, Request $request)
    {
        if($category=Category::find($id)) {
            $category->delete();
            return redirect()->back()->withMessage('Successfully Deleted');
        }
        return redirect()->back()->withErrors('unable to delete');
    }
}

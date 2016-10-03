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
     public function index(Request $request)
    {
        $categories=Category::paginate(5);
        //dd($category);
        return view ('categoryIndex', compact('categories', 'request'));
    } 
    
     public function search(Request $request)
    {
        $categories=$this->dispatch(new SearchCategory());
        
        return view('categoryIndex', compact('categories', 'request'));
    }
    
    public function create()
    {
        $category= new Category();
        //dd($category);
        return view('category', compact('category'));
    }
    
     public function store(CreateCategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->back()->with('message', 'Submitted Successfully');
    }
    
    public function edit($id, Request $request)
    { 
        $category = Category::find($id);
        return view('category', compact('category'));
    }
    
    public function update($id, Request $request)
    {  
        if ($category = Category::find($id)) {
            $category->update($request->toArray());
            return redirect()->back()
                ->withMessage('successfully updated');
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

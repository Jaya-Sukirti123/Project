<?php

namespace App\Jobs;

use App\model\Category;

class SearchCategory 
{
    
    public function handle(Category $category, Request $request)
    {
        $categories = Category::where('category_name','LIKE','%$request->category_name%')->get();
        return view ('categoryIndex', compact('categories'));   
    }
}

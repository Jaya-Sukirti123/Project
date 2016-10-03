<?php

namespace App\Jobs;

use App\model\Category;

class SearchCategory 
{
    
    public function handle(Category $category, Request $request)
    {
        $categories = $category->where(function($q) use ($request) {
            return $q->orWhere('category_name', 'LIKE', '%'.$request->get('search').'%');
                    
        });

        return $categories->paginate(5);   
    }
}

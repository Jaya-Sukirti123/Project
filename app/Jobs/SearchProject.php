<?php

namespace App\Jobs;

use App\model\Project;
use Symfony\Component\HttpFoundation\Request;

class SearchProject
{
    public function handle(Project $project, Request $request)
    {
        $projects = $project->where(function($q) use ($request) {
            return $q->orWhere('title', 'LIKE', '%'.$request->get('search').'%')
                    ->orWhere('description', 'LIKE', '%'.$request->get('search').'%')
                    ->orWhere('reference_to', 'LIKE', '%'.$request->get('search').'%');
        });

        if ($request->has('priority')) {
            $projects = $projects->where('priority', $request->get('priority'));
        }
        
        return $projects->paginate(10);
    }
}

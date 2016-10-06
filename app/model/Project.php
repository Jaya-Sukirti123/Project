<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['title','description','timer','reference_to','priority'];
    
    public  function categories()
    {
        return $this->belongsToMany(Category::class, 'projects_categories');
    }
}
 
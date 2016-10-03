<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['title','description','timer','reference_to','priority','category'];
}
 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{

    // $rubric = Rubric::find(1);
    // $rubric->post;
    public function posts()
    {
        // return $this->hasOne('App\Models\Post');
        return $this->hasMany(Post::class, 'rubric_id');
    }
    use HasFactory;
}

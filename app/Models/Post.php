<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    // загуглить это
    // protected $table = 'my_posts';
    // protected $primaryKey = 'post_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    protected $attributes = [ // список атрибутов по умолчанию с их значениями
        'content' => 'Lorem ipsum...'
    ];
    protected $fillable = [ // список разрешенных атрибутов для массового заполнения 
        'title',
        'content',
        'rubric_id',
        // 'user_id',
    ];
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user_id()
    {
        return $this->belongsTo(User::class);
    }
    public function getPostDate()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    use HasFactory;
}

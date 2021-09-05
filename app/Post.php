<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    protected $fillable = [
        'title', 'body', 'iframe', 'image', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGetExcerptAttribute($name)
    {
        return substr($this->body, 0, 140);
    }

    public function getGetImageAttribute()
    {
        if($this->image)
            return url("storage/$this->image");
    }
}

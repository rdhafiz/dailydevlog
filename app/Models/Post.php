<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'category_ids',
        'featured_image',
        'status',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
        'is_featured',
        'allow_comments',
    ];


    public function author()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $appends = ['created_at_format', 'published_at_format', 'categories'];

    public function getCategoriesAttribute()
    {
        $categories = PostCategory::with('category')->where('post_id', $this->id)->get()->toArray();
        $rv = [];
        foreach ($categories as $each){
            $rv[] = $each['category'];
        }
        return $rv;
    }

    public function getCreatedAtFormatAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return date('d/m/Y', strtotime($this->attributes['created_at']));
        }
        return null;
    }

    public function getPublishedAtFormatAttribute()
    {
        if (isset($this->attributes['published_at'])) {
            return date('d/m/Y', strtotime($this->attributes['created_at']));
        }
        return null;
    }
}

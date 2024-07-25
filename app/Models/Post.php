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
        'featured_image',
        'status',
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
    protected $appends = ['categories', 'created_at_format'];

    public function getCategoriesAttribute()
    {
        $post_categories = PostCategory::with('category')->where('post_id', $this->id)->get()->toArray();
        $rv = [];
        foreach ($post_categories as $each){
            $rv[] = array($each);
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
}

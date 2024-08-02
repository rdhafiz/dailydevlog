<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $appends = ['created_at_format'];

    public function getCreatedAtFormatAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return date('d/m/Y', strtotime($this->attributes['created_at']));
        }
        return null;
    }
}

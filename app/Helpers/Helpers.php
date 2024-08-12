<?php

use App\Models\Tag;

if (!function_exists('getPopularTags')) {
    function getPopularTags(){
        return  Tag::orderBy('count', 'desc')->take(5)->get();
    }
}



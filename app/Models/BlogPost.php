<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $guarded = [];

    public function blog(){

        return $this->belongsTo(BlogCategory::class,'blog_cat_id','id');
    }
}

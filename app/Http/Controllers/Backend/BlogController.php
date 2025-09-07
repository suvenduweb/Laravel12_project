<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function BlogCategory(Request $request){
        $category = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.blog_category',compact('category'));
    }

    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);

        $notification =array(
        'message' => 'Blog Category Inserted Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.blog.category')->with($notification);
    }


}

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

    public function EditBlogCategory($id){
        $categorys =  BlogCategory::find($id);
        return response()->json($categorys);
    }

    public function UpdateBlogCategory(Request $request){
        $cat_id = $request->cat_id;
         BlogCategory::find($cat_id)->update([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);

        $notification =array(
        'message' => 'Blog Category Updated Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.blog.category')->with($notification);
    }

    public function DeleteBlogCategory($id){
        $categorys =  BlogCategory::find($id)->delete();
        $notification =array(
        'message' => 'Blog Category Delete Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.blog.category')->with($notification);
    }
    // sfd
}

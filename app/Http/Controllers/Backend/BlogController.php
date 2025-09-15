<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
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
    public function AllBlogPost(){
        $post = BlogPost::latest()->get();
        return view('admin.backend.post.all_post',compact('post'));
    }
    public function AddBlogPost(){
        $blogcat =  BlogCategory::latest()->get();
        return view('admin.backend.post.add_post',compact('blogcat'));
    }



    public function StoreBlogPost(Request $request ){

       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(746,500)->save(public_path('upload/post'.$name_gen));
            $save_url = 'upload/post'.$name_gen;
       }

       BlogPost::create([
        'blog_cat_id' => $request->blog_cat_id,
        'post_title' => $request->post_title,
        'post_slug' => strtolower(str_replace(' ', '-',$request->post_slug)),
        'long_descp' => $request->long_descp,
        'image' => $save_url,

       ]);

       $notification =array(
        'message' => 'Blog Post Inserted Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.blog.post')->with($notification);

    }

}

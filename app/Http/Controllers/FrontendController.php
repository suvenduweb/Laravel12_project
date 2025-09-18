<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FrontendController extends Controller
{
    public function OurTeam(){
        return view('home.team.team_page');
    }

    public function AboutUs(){
        return view('home.about.about_us');
    }

    public function getAboutUs(){
        $about = About::find(1);
        return view('admin.backend.about.get_about',compact('about'));
    }

    public function updateAboutUs(Request $request ){

        $about_id = $request->id;
        $about = About::find($about_id);

       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(526,550)->save(public_path('upload/about/'.$name_gen));
            $save_url = 'upload/about/'.$name_gen;

            if (file_exists(public_path($about->image))) {
                @unlink(public_path($about->image));
            }

            About::find($about_id)->update([
                'title' => $request->title,

                'description' => $request->description,
                'image' => $save_url,

            ]);

            $notification =array(
                'message' => 'About Update With Image  Successfully',
                'alert-type' => 'success',
            );
       }else{
            About::find($about_id)->update([
                'title' => $request->title,

                'description' => $request->description,


            ]);

            $notification =array(
                'message' => 'About Update Without Image Successfully',
                'alert-type' => 'success',
            );
       }


       return redirect()->back()->with($notification);

    }

    public function BlogePage(){

        $blogcat =  BlogCategory::latest()->withCount('posts')->get();
        $post = BlogPost::latest()->limit(5)->get();
        $resent_post = BlogPost::latest()->limit(3)->get();
        return view('home.blog.list_blog',compact('blogcat','post','resent_post'));
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Contact;
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

    public function BlogDetails($slug){

         $post = BlogPost::where('post_slug',$slug)->first();
         $resent_post = BlogPost::latest()->limit(3)->get();
         $blogcat =  BlogCategory::latest()->withCount('posts')->get();
         return view('home.blog.blog_details',compact('post','resent_post','blogcat'));

    }
    public function BlogCategory($id){

         $post = BlogPost::where('blog_cat_id',$id)->get();
         $resent_post = BlogPost::latest()->limit(3)->get();
         $blogcat =  BlogCategory::latest()->withCount('posts')->get();
         $categoryname =  BlogCategory::where('id',$id)->first();
         return view('home.blog.blog_category',compact('post','resent_post','blogcat','categoryname'));

    }

    public function ContactUs(){
        return view('home.contact.contact_us');
    }

    public function ContactMessage(Request $request ){

       Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
       ]);

       $notification =array(
        'message' => 'Your Message Sent Successfully',
        'alert-type' => 'success',
       );
       return redirect()->back()->with($notification);

    }

    public function ContactAllMessage(){
        $message = Contact::latest()->get();
        return view('admin.backend.contact.all_message',compact('message'));
    }

    public function DeleteMessage($id){

        Contact::find($id)->delete();
        $notification =array(
        'message' => ' Delete Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('contact.all.message')->with($notification);
    }

}

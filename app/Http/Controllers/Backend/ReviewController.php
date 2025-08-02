<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReviewController extends Controller
{
    public function AllReview(){
        $review = Review::latest()->get();
        return view('admin.backend.review.all_review',compact('review'));
    }
    public function AddReview(){

        return view('admin.backend.review.add_review');
    }

    public function StoreReview(Request $request ){

       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(60,60)->save(public_path('upload/review'.$name_gen));
            $save_url = 'upload/review'.$name_gen;
       }

       Review::create([
        'name' => $request->name,
        'position' => $request->position,
        'message' => $request->message,
        'image' => $save_url,

       ]);

       $notification =array(
        'message' => 'Review Inserted Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.review')->with($notification);

    }

    public function EditReview($id){
        $review = Review::find($id);
        return view('admin.backend.review.edit_review',compact('review'));
    }

    public function UpdateReview(Request $request ){

        $rev_id = $request->id;
       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(60,60)->save(public_path('upload/review'.$name_gen));
            $save_url = 'upload/review'.$name_gen;

            Review::find($rev_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $save_url,

            ]);

            $notification =array(
                'message' => 'Review Update With Image  Successfully',
                'alert-type' => 'success',
            );
       }else{
            Review::find($rev_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,


            ]);

            $notification =array(
                'message' => 'Review Update Without Image Successfully',
                'alert-type' => 'success',
            );
       }


       return redirect()->route('all.review')->with($notification);

    }

    public function DeleteReview($id){

        $item = Review::find($id);
        $img = $item->image;
        unlink($img);
        Review::find($id)->delete();

        $notification =array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Clarifi;
use App\Models\Financial;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeController extends Controller
{
    public function AllFeature(){
        $feature = Feature::latest()->get();
        return view('admin.backend.feature.all_feature',compact('feature'));
    }

    public function AddFeature(){

        return view('admin.backend.feature.add_feature');
    }

    public function StoreFeature(Request $request ){

       Feature::create([
        'title' => $request->title,
        'icon' => $request->icon,
        'description' => $request->description,
       ]);

       $notification =array(
        'message' => 'Feature Inserted Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.feature')->with($notification);

    }

    public function EditFeature($id){
        $feature = Feature::find($id);
        return view('admin.backend.feature.edit_feature',compact('feature'));
    }

    public function UpdateFeature(Request $request ){

        $fea_id = $request->id;

            Feature::find($fea_id)->update([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,


            ]);

            $notification =array(
                'message' => 'Feature Update Successfully',
                'alert-type' => 'success',
            );

       return redirect()->route('all.feature')->with($notification);
    }

    public function DeleteFeature($id){

        Feature::find($id)->delete();

        $notification =array(
            'message' => 'Feature Update Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function GetClarifies(){
        $clarifi = Clarifi::find(1);


        return view('admin.backend.clarifi.get_clarifi',compact('clarifi'));
    }


    public function UpdateClarifies(Request $request ){

        $clr_id = $request->id;
        $clarifi = Clarifi::find($clr_id);

       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(302,618)->save(public_path('upload/clarifi/'.$name_gen));
            $save_url = 'upload/clarifi/'.$name_gen;

            if (file_exists(public_path($clarifi->image))) {
                @unlink(public_path($clarifi->image));
            }

            Clarifi::find($clr_id)->update([
                'title' => $request->title,

                'description' => $request->description,
                'image' => $save_url,

            ]);

            $notification =array(
                'message' => 'Clarifi Update With Image  Successfully',
                'alert-type' => 'success',
            );
       }else{
            Clarifi::find($clr_id)->update([
                'title' => $request->title,

                'description' => $request->description,


            ]);

            $notification =array(
                'message' => 'Clarifi Update Without Image Successfully',
                'alert-type' => 'success',
            );
       }


       return redirect()->back()->with($notification);

    }

    public function GetFinancial(){
        $financial = Financial::find(1);


        return view('admin.backend.financial.get_financial',compact('financial'));
    }

    public function UpdateFinancial(Request $request ){

        $financial_id = $request->id;
        $financial = Financial::find($financial_id);

       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(307,619)->save(public_path('upload/financial/'.$name_gen));
            $save_url = 'upload/financial/'.$name_gen;

            if (file_exists(public_path($financial->image))) {
                @unlink(public_path($financial->image));
            }

            Financial::find($financial_id)->update([
                'title' => $request->title,

                'description' => $request->description,
                'unified_dashboard' => $request->unified_dashboard,
                'realtime_update' => $request->realtime_update,
                'image' => $save_url,

            ]);

            $notification =array(
                'message' => 'Financial Update With Image  Successfully',
                'alert-type' => 'success',
            );
       }else{
            Financial::find($financial_id)->update([
                'title' => $request->title,
                'unified_dashboard' => $request->unified_dashboard,
                'realtime_update' => $request->realtime_update,
                'description' => $request->description,


            ]);

            $notification =array(
                'message' => 'Financial Update Without Image Successfully',
                'alert-type' => 'success',
            );
       }


       return redirect()->back()->with($notification);

    }
}

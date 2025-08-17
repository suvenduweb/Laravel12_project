<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Clarifi;
use App\Models\Financial;
use App\Models\Usability;
use App\Models\Connect;
use App\Models\Faq;
use App\Models\App;
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

    public function GetUsability(){
        $usability = Usability::find(1);


        return view('admin.backend.usability.get_usability',compact('usability'));
    }

    public function UpdateUsability(Request $request ){

        $usability_id = $request->id;
        $usability = Usability::find($usability_id);

       if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(560,400)->save(public_path('upload/usability/'.$name_gen));
            $save_url = 'upload/usability/'.$name_gen;

            if (file_exists(public_path($usability->image))) {
                @unlink(public_path($usability->image));
            }

            Usability::find($usability_id)->update([
                'title' => $request->title,

                'description' => $request->description,
                'link' => $request->link,
                'youtube' => $request->youtube,
                'image' => $save_url,

            ]);

            $notification =array(
                'message' => 'Usability Update With Image  Successfully',
                'alert-type' => 'success',
            );
       }else{
            Usability::find($usability_id)->update([
                'title' => $request->title,
                'link' => $request->link,
                'youtube' => $request->youtube,
                'description' => $request->description,


            ]);

            $notification =array(
                'message' => 'Usability Update Without Image Successfully',
                'alert-type' => 'success',
            );
       }


       return redirect()->back()->with($notification);

    }


    public function AllConnect(){
        $connect = Connect::latest()->get();
        return view('admin.backend.connect.all_connect',compact('connect'));
    }

    public function AddConnect(){
        return view('admin.backend.connect.add_connect');
    }

    public function StoreConnect(Request $request ){

       Connect::create([
        'title' => $request->title,

        'description' => $request->description,
       ]);

       $notification =array(
        'message' => 'Connect Inserted Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.connect')->with($notification);

    }

    public function EditConnect($id){
        $connect = Connect::find($id);
        return view('admin.backend.connect.edit_connect',compact('connect'));
    }


    public function UpdateConnect(Request $request ){

        $con_id = $request->id;

            Connect::find($con_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification =array(
                'message' => 'Connect Update Successfully',
                'alert-type' => 'success',
            );

       return redirect()->route('all.connect')->with($notification);
    }

    public function DeleteConnect($id){

        Connect::find($id)->delete();

        $notification =array(
            'message' => 'Connect Update Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DirectUpdateConnect(Request $request, $id){

        $connect = Connect::findOrFail($id);
        $connect->update($request->only(['title', 'description']));
        return response()->json(['success' => true, 'message' => "Updated Successfully"]);

    }

    public function AllFaq(){
        $faq = Faq::latest()->get();
        return view('admin.backend.faq.all_faq',compact('faq'));
    }

    public function AddFaq(){
        return view('admin.backend.faq.add_faq');
    }

    public function StoreFaq(Request $request ){

       Faq::create([
        'title' => $request->title,

        'description' => $request->description,
       ]);

       $notification =array(
        'message' => 'Faq Inserted Successfully',
        'alert-type' => 'success',
       );
       return redirect()->route('all.faq')->with($notification);

    }

    public function EditFaq($id){
        $faq = Faq::find($id);
        return view('admin.backend.faq.edit_faq',compact('faq'));
    }


    public function UpdateFaq(Request $request ){

        $faq_id = $request->id;

            Faq::find($faq_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification =array(
                'message' => 'Faq Update Successfully',
                'alert-type' => 'success',
            );

       return redirect()->route('all.faq')->with($notification);
    }

    public function DeleteFaq($id){

        Faq::find($id)->delete();

        $notification =array(
            'message' => 'Faq Delete Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DirectUpdateApp(Request $request, $id){
        $app = App::findOrFail($id);
        $app->update($request->only(['title', 'description']));
        return response()->json(['success' => true, 'message' => "Updated Successfully"]);
    }

    public function DirectUpdateAppImge(Request $request, $id){
        $app = App::findOrFail($id);

        if ($request->file('image')) {
            $image= $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(360,481)->save(public_path('upload/apps/'.$name_gen));
            $save_url = 'upload/apps/'.$name_gen;

            if (file_exists(public_path($app->image))) {
                        @unlink(public_path($app->image));

                }

            $app->update([
                'image' => $save_url,
            ]);

            return response()->json(['success' => true, 'image_url' => $save_url, 'message' => "Updated Successfully"]);
       }

       return response()->json(['success' => false,  'message' => "Upload Failed"],400);
    }
}

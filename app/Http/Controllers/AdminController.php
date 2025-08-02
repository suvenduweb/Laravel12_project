<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminLogin(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $user =  Auth::user();
            $verificationCode = random_int(100000,999999);

            session(['vericaficition_code' => $verificationCode, 'user_id'=> $user->id]);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            Auth::logout();
            return redirect()->route('custom.verifaction.form')->with('status','verification code sent to your email');
        }
        // return redirect()->back()->withError(['email'=>'invalid credentials provided ']);
        // return redirect()->back()->with('error', 'Invalid credentials provided');
        return redirect()->back()->withErrors(['email' => 'Invalid credentials provided']);
    }

    public function ShowVerification(){
        return view('auth.verify');
    }
    public function VerificationVerify(Request $request){

        $request->validate(['code' => 'required|numeric']);
        if($request->code == session('vericaficition_code')){

            Auth::loginUsingId(session('user_id'));
            session()->forget(['vericaficition_code','user_id']);
            return redirect()->intended('/dashboard');

        }
        return back()->withErrors(['code'=>'Invalid Verification Code']);
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile',compact('profileData'));
    }

    public function ProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$filename);
            $data->photo = $filename;
        }

        if ($oldPhotoPath && $oldPhotoPath != $filename) {
            $this->deleteOldImage($oldPhotoPath);
        }

        $data->save();
        $notification = array(
            'message' => 'Profile Update Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    protected function deleteOldImage(string $oldPhotoPath) : void
    {
        $fullPath = public_path('upload/user_images/' . $oldPhotoPath);

        if (file_exists($fullPath) && is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    public function PasswordUpdate(Request $request){
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required | confirmed',
        ]);
        if (!Hash::check($request->old_password,$user->password)) {
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' > 'error',
            );
            return redirect()->back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        Auth::logout();

        $notification = array(
            'message' => 'Password Update Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('login')->with($notification);

    }
}

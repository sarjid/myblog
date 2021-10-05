<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.home');
    }

    // ======================== Admin Profile ============
    public function profile(){
        $user = Auth::user();
        return view('admin.profile.index',compact('user'));
    }

    //update profile
    public function profileUpdate(Request $request){
        $user = User::find(auth()->user()->id);
        if ($request->has('image')) {
            $image = $request->image;
            $imgName = Str::slug($request->input('name'),'-').uniqid().'.'.$image->getClientOriginalExtension();
            //create directory
            if (!Storage::disk('public')->exists('user')) {
                Storage::disk('public')->makeDirectory('user');
            }
             //delete old image
             if (Storage::disk('public')->exists('user/'.$user->image)) {
                Storage::disk('public')->delete('user/'.$user->image);
            }
           $userImg = Image::make($image)->fit(200,200)->stream();
            Storage::disk('public')->put('user/'.$imgName,$userImg);
            $user->image = $imgName;
         }

         $user->username = $request->username;
         $user->name = $request->name;
         $user->about = $request->about;
         $user->save();

         Toastr::success('User Update Success');
         return redirect()->back();
    }


    //password password
    public function passwordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
         $user = User::find(Auth::id());
        $hashedPassword = $user->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            Toastr::error('Password Changed Success');
            return redirect()->back();
        }else {
            Toastr::error('old password not match');
            return redirect()->back();
        }
    }
}

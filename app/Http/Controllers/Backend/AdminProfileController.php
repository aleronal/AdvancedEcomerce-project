<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function EditAdminProfile()
    {
        $id = Auth::user()->id;
        $editData = Admin::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
    }
    public function UpdateAdminProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = Admin::find($id);
      
        $data->name = $request->name;
        $data->email = $request->email;


        if(!empty($request->profile_photo_path)){

            unlink($request->oldimage);
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225,225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/'. $name_gen;
            
            $data->update([
                'profile_photo_path' => $save_url,
            ]);  

        $notification = array(
            'message' => 'Admin Profile Updated Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);


    }
}

    public function AdminChangePassword()
    {
        
       
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {

        $id = Auth::user()->id;
        $adminData = Admin::find($id);

        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedpassword = Admin::find($adminData)->password;
        if(Hash::check($request->oldpassword, $hashedpassword))
        {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();

            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }

        
    }

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.view_users',compact('users'));
    }
}

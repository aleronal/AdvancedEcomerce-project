<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminUserController extends Controller
{
    public function AllAdminRole()
    {

        $adminuser = Admin::where('type', '2')->latest()->get();
        
        return view('backend.role.admin_role_all',compact('adminuser'));

    }

    public function AddAdminUser()
    {
        return view('backend.role.add_admin_user');
    }

    public function StoreAdminUser(Request $request)
    {
            
        $image = $request->file('profile_photo_path');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(225,225)->save('upload/admin_images/' . $name_gen);
        $save_url = 'upload/admin_images/'. $name_gen;
                
        

        Admin::insert([
        
            'name' => ucwords($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $save_url,
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'orders' => $request->orders,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,
            'type' => 2,
            'created_at' => Carbon::now(),
            
        ]);
        

        $notification = array(
            'message'=> 'Admin Inserted Successfully',
            'alert-type' => 'info'

        );

        return redirect()->route('all-admin-user')->with($notification);
    }

    public function EditAdminUser($id)

    {
        $admin = Admin::findOrFail($id);
        return view('backend.role.edit_admin_user',compact('admin'));
    }

    public function UpdateAdmin(Request $request)
    {
        $admin = Admin::findOrFail($request->id);

        if(!empty($request->profile_photo_path)){

        unlink($request->oldimage);
        $image = $request->file('profile_photo_path');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(225,225)->save('upload/admin_images/' . $name_gen);
        $save_url = 'upload/admin_images/'. $name_gen;
        
        $admin->update([
            'profile_photo_path' => $save_url,
        ]);  
    }


        $admin->update([
        
            'name' => ucwords($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            // 'password' => Hash::make($request->password),
            
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'orders' => $request->orders,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,
            'type' => 2,
            'updated_at' => Carbon::now(),
            
        ]);
        

        $notification = array(
            'message'=> 'Admin Updated Successfully',
            'alert-type' => 'info'

        );

        return redirect()->route('all-admin-user')->with($notification);
    }

    public function DeleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);

        $img = $admin->profile_photo_path;

        unlink($img);
        

        $admin->delete();
        $notification = array(
            'message'=> 'Admin Deleted Successfully',
            'alert-type' => 'info'

        );

        return redirect()->route('all-admin-user')->with($notification);
    }
   
}

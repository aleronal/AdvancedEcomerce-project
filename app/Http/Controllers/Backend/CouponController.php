<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function ViewCoupon()
    {
        
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.view_coupon',compact('coupons'));
    }

    public function StoreCoupon(Request $request)
    {
        $request->validate([

            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',

        ]);

        Coupon::insert([

            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'Coupon Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditCoupon($id)
    {
         
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon',compact('coupon'));
    }

    public function UpdateCoupon(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'Coupon Updated Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('manage.coupon')->with($notification);
    }

    public function DeleteCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        $notification = array(
            'message'=> 'Coupon Deleted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.coupon')->with($notification);
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    public function ReturnRequested()
    {
        $orders = Order::where('return_order', '1')->orderBy('id','DESC')->get();

        return view('backend.return_order.return_request', compact('orders'));

    }

    public function ReturnApproved($id)
    {
        $orders = Order::where('id', $id)->update([
            'return_order' => 2,
        ]);

        $notification = array(
            'message' => 'Return Order Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ReturnAllRequest()
    {
        $orders = Order::where('return_order', '2')->orderBy('id','DESC')->get();

        return view('backend.return_order.all_return_request', compact('orders'));
    }

   

    
}

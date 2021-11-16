<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {
        if(Session::has('coupon'))
        {
            $total_amount = Session::get('coupon')['total_amount'];
            
        } else {
            $total_amount = Cart::total();
            
        }


        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'USD',
            'amount' => $total_amount,
            
            'invoice_number' => 'EOS'.mt_rand(1000000000,9999999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),

        ]);
        
        // send email
        $order = Order::findOrFail($order_id);

        $data = [
            'invoice_number' => $order->invoice_number,
            'amount' => $order->amount,
            'name' => $order->name,
            'email' => $order->email,
        ];
            Mail::to($request->email)->send(new OrderMail($data));


        $carts = Cart::content();
        foreach($carts as $cart)
        {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        // deleting everything(Session and Cart) after the Cash payment was successfully

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();
        // -----------------------------------------------///

        $notification = array(
            'message' => 'Your Order Was Placed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);

    }
    
    
}

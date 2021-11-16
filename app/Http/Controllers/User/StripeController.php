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

class StripeController extends Controller
{
    public function StripeOrder(Request $request)
    {

        if(Session::has('coupon'))
        {
            $total_amount = Session::get('coupon')['total_amount'];
            
        } else {
            $total_amount = Cart::total();
            
        }
    
    \Stripe\Stripe::setApiKey('sk_test_51Jr4RwETxGMTVanauQr0frprPqsV8563Cm5RKX5XAvBurGKI3NjtILDZkA0VOwxwuzk4esiVeNJP8SZe0BmFymXy006UuA4dHO');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Easy Online Store',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        

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

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

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

        // deleting everything(Session and Cart) after the stripe payment was successfully

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

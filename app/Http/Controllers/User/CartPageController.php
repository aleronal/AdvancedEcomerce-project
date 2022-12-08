<?php

namespace App\Http\Controllers\User;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function MyCart()
    {
        return view('frontend.wishlist.mycart_view');
    }

    public function GetCartProduct()
    {
        
            $cart = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
    
            return response()->json(array(
                'cart' => $cart,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal
            ));
        
    }

    public function RemoveCartProduct($rowId)
    {   
        Cart::remove($rowId);

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        return response()->json(['success' => 'Product Removed From Cart']);
    }


    public function IncrementCart($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupon'))
            {
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();


                $getTotal = Cart::total();
                $removeDot = str_replace('.', '', $getTotal);
                $removeComma = str_replace(',','', $removeDot);
                $cartTotal = $removeComma;


               Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $cartTotal * $coupon->coupon_discount/100, 
                'total_amount' => $cartTotal - ($cartTotal * $coupon->coupon_discount/100 ) 
            ]);
        }

        return response()->json('increment');
    }

    public function DecrementCart($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if(Session::has('coupon'))
        {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();


            $getTotal = Cart::total();
            $removeDot = str_replace('.', '', $getTotal);
            $removeComma = str_replace(',','', $removeDot);
            $cartTotal = $removeComma / 100;


           Session::put('coupon',[
            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => $cartTotal * $coupon->coupon_discount/100, 
            'total_amount' => $cartTotal - $cartTotal * $coupon->coupon_discount/100  
        ]);

        return response()->json('decrement');
        }
    
    }

}

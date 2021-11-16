<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {

        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);

        if($product->discount_price == NULL)
        {
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->selling_price,
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
                    
            ]);

            return response()->json(['success' => 'Sucessfully Added on Your Cart']);
        }else{
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->discount_price,
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size
                ],
                    
            ]);
            return response()->json(['success' => 'Sucessfully Added on Your Cart']);
        }

    }

    public function AddMiniCart()
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

    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        
        return response()->json(['success' => 'Product Removed Succesfully']);

    }

    public function ApplyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if($coupon)
            {
                $getTotal = Cart::total();
                $removeDot = str_replace('.', '', $getTotal);
                $removeComma = str_replace(',','', $removeDot);
                $cartTotal = $removeComma;


               Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $cartTotal * $coupon->coupon_discount/100, 
                'total_amount' => $cartTotal - ($cartTotal * $coupon->coupon_discount /100)
            ]);
               

                
                
                return response()->json(array(
                    'validity' => true,
                    'success' => ' Coupon Applied Succesfully',
                ));
                

        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
        
    }

    public function CouponCalculation()
    {
        if(Session::has('coupon'))
        {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total()
            ));
        }
    }

    public function RemoveCoupon()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);

    }

    public function CreateCheckout()
    {
        if(Auth::check())
        {
            if(Cart::total() > 0 )
            {
                $cart = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();

                return view('frontend.checkout.view_checkout',compact('cart', 'cartQty', 'cartTotal','divisions'));

            }else{
                $notificiation = array(
                    'message' => 'Please Add Something to Your Cart',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notificiation);
            }
            
        }else{

            $notificiation = array(
                'message' => 'You Need To Login First',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notificiation);
        }
        
    }




}

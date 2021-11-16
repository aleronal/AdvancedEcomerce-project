<?php

namespace App\Http\Controllers\User;

use App\Models\ShipState;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class Checkoutcontroller extends Controller
{
    public function DistrictGetAjax($id)
    {
        $ship = ShipDistrict::where('division_id', $id)->orderBy('district_name', 'ASC')->get();
         
        return json_decode($ship);

    }

    public function StateGetAjax($id)
    {
        $state = ShipState::where('district_id', $id)->orderBy('state_name', 'ASC')->get();
        return json_decode($state);
    }

    public function StoreCheckout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name; 
        $data['shipping_email'] = $request->shipping_email; 
        $data['shipping_phone'] = $request->shipping_phone; 
        $data['post_code'] = $request->post_code; 
        $data['division_id'] = $request->division_id; 
        $data['district_id'] = $request->district_id; 
        $data['state_id'] = $request->state_id; 
        $data['notes'] = $request->notes; 

        $cartTotal = Cart::total();



        if($request->payment_method == 'stripe')
        {
            return view('frontend.payment.stripe', compact('data','cartTotal'));
        }elseif($request->payment_method == 'cash')
        {
            return view('frontend.payment.cash', compact('data','cartTotal'));
            
        }else{
            return 'cash';
        }
    }
}

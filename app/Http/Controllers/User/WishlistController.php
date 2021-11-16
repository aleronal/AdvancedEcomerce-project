<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishlist(Request $request, $product_id)
    {
        if(Auth::check()){

            $exist = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if(!$exist){
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_At' => Carbon::now()
            ]);

            return response()->json(['success'=>'Product Added To Your Wishlist']);

            }else{
            return response()->json(['error'=>'This Product its already on your wishlist']); 
            }
        }else{
            return response()->json(['error'=>'Please Login to Your Account']);
        }
    }

    public function ViewWishlist()
    {
        return view('frontend.wishlist.view_wishlist');
    }

    public function GetWishlistProduct()
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        return response()->json($wishlist);
    }
    public function RemoveWishlistProduct($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success'=>'Product Remove from Wishlist Successfully']);
        
    }


}

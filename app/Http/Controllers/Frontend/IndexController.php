<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPost;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('status', '1')->orderBy('id', 'DESC')->limit(8)->get();
        $features = Product::where('featured', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $hotDeals = Product::where('hot_deals', '1')->where('discount_price','!=',NUll)->orderBy('id', 'DESC')->limit(3)->get();
        $specialOffer = Product::where('special_offer', '1')->orderBy('id', 'DESC')->limit(3)->get();
        $specialDeals = Product::where('special_deals', '1')->orderBy('id', 'DESC')->limit(3)->get();

        $skipCategory_0 = Category::skip(0)->first();
        $skipProduct_0 = Product::where('status', 1)->where('category_id',$skipCategory_0->id)->orderBy('id', 'DESC')->get();
        $skipCategory_1 = Category::skip(1)->first();
        $skipProduct_1 = Product::where('status', 1)->where('category_id',$skipCategory_1->id)->orderBy('id', 'DESC')->get();
        $blog_post = BlogPost::latest()->get();
        // return $skipCategory->id;

        
        return view('frontend.index',compact('categories','sliders','products','features','hotDeals','specialOffer','specialDeals','skipCategory_0', 'skipProduct_0','skipCategory_1','skipProduct_1','blog_post'));
    }

    public function UserLogout()
    {
        Auth::logout();
        return redirect()->route('login');

    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileEdit(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->file('profile_photo_path'))
        {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/' . $user->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $user['profile_photo_path'] = $filename;
        }
        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);

    }

    public function UserPassword()
    {
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function UserPasswordUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedpassword = $user->password;
        if(Hash::check($request->old_password, $hashedpassword))
        {
            
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();
            return redirect()->route('user.logout');
        }else {
            $notification = array(
                'message' => 'The passwords did not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function DetailsProduct($id, $slug)
    {   
        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_es = $product->product_color_es;
        $product_color_es = explode(',', $color_es);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_es = $product->product_size_es;
        $product_size_es = explode(',', $size_es);

        // to get the related category id for $relatedProduct
        $cat_id = $product->category_id;

        $related_product = Product::where('category_id', $cat_id)->where('id', '!=',$id)->orderBy('id', 'DESC')->get();
        
        $multimage = MultiImage::where('product_id',$id)->get();
        return view('frontend.product.details_product',compact('product','multimage','product_color_en','product_color_es','product_size_en','product_size_es','related_product'));
    }

    public function TagWiseProduct($tag)
    {
        $products = Product::where('status', '1')->where('product_tags_en', $tag)->where('product_tags_es', $tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.tags.view_tags',compact('products','categories'));
    }

    // subcategory wise data 
    public function SubCatWiseProduct($subcat_id, $slug)
    {
        $products = Product::where('status', '1')->where('sub_category_id', $subcat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $breadsubcat = SubCategory::with(['category'])->where('id', $subcat_id)->get();

        return view('frontend.product.subcategory_view', compact('products','categories','breadsubcat'));
    }

    public function SubsubCatWiseProduct($subsubcat_id, $slug)
    {
        $products = Product::where('status', '1')->where('sub_sub_category_id', $subsubcat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $breadsubsubcat = SubSubCategory::with(['category','subcategory'])->where('id', $subsubcat_id)->get();

        return view('frontend.product.subsubcategory_view', compact('products','categories','breadsubsubcat'));
    }


    // Product View With Ajax
    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color_en = explode(',', $color);

        $size = $product->product_size_en;
        $product_size_en = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color_en,
            'size' => $product_size_en,
        ));
    }

    public function ProductSearch(Request $request)
    {   
        $request->validate(['search' => 'required']);

        $search = $request->search;

        $products = Product::where('product_name_en', 'LIKE',"%$search%")->paginate(5);

        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.product.search', compact('products',
        'categories'));

    }   

    // Advance Search Option

    public function SearchProduct(Request $request)
    {
        $request->validate(['search' => 'required']);

        $search = $request->search;

        $products = Product::where('product_name_en', 'LIKE',"%$search%")->select('product_name_en','product_thumbnail','selling_price','id', 'product_slug_en')->limit(5)->get();

        return view('frontend.product.search_product', compact('products'));

    }
}

<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\AssignOp\Mul;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add',compact('categories', 'brands'));
        
    }

    public function StoreProduct(Request $request)
    {

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnails/' . $name_gen);
        $save_url = 'upload/products/thumbnails/'. $name_gen;

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'sub_sub_category_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_es' => $request->product_name_es,
            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_es' => strtolower(str_replace(' ','-',$request->product_name_es)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_es' => $request->product_tags_es,
            'product_size_en' => $request->product_size_en,
            'product_size_es' => $request->product_size_es,
            'product_color_en' => $request->product_color_en,
            'product_color_es' => $request->product_color_es,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description_en' => $request->short_description_en,
            'short_description_es' => $request->short_description_es,
            'description_en' => $request->description_en,
            'description_es' => $request->description_es,
            
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

            // Multi Image upload Start

            $images = $request->file('multi_img');
            foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/'. $make_name;
            

            MultiImage::insert([
               'product_id' => $product_id,
               'photo_name' => $uploadPath,
               'created_at' => Carbon::now(),

            ]);

        }
            // End Multi Image 

            $notification = array(
                'message' => 'Product Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage.product')->with($notification);



    }

    public function ManageProduct()
    {
        $products = Product::latest()->get();

        return view('backend.product.product_view',compact('products'));
    }

    public function EditProduct($id)
    {
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $product = Product::findOrFail($id);
        $multi_image = MultiImage::where('product_id', $id)->get();

        return view('backend.product.product_edit',compact('categories','subcategory','subsubcategory', 'brands', 'product','multi_image'));
    }

    public function UpdateProduct(Request $request, $id)
    {
        
        $product_id = Product::findOrFail($id);

        $product_id->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'sub_sub_category_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_es' => $request->product_name_es,
            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_es' => strtolower(str_replace(' ','-',$request->product_name_es)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_es' => $request->product_tags_es,
            'product_size_en' => $request->product_size_en,
            'product_size_es' => $request->product_size_es,
            'product_color_en' => $request->product_color_en,
            'product_color_es' => $request->product_color_es,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description_en' => $request->short_description_en,
            'short_description_es' => $request->short_description_es,
            'description_en' => $request->description_en,
            'description_es' => $request->description_es,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Updated without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.product')->with($notification);




    }

    public function MultiImageUpdate(Request $request)
    {

        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/' . $make_name);
            $save_url = 'upload/products/multi-image/'. $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $save_url,
                'updated_at' => Carbon::now(),

            ]);
        }

        $notification = array(
            'message' => 'Product Updated with Image Successfully',
            'alert-type' => 'info'
        );  

        return redirect()->back()->with($notification);


    }

    public function ThumbnailImageUpdate(Request $request, $id)
    {
        $product_id = Product::findOrFail($id);
        $old_img = $request->old_image;

        unlink($old_img);

        $img = $request->file('product_thumbnail');
        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(917,1000)->save('upload/products/thumbnails/' . $make_name);
        $save_url = 'upload/products/thumbnails/'. $make_name;

        $product_id->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Product Thumbnail updated Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
 
        
    }

    public function MultiImageDelete($id)
    {
        $old_image = MultiImage::findOrFail($id);
        unlink($old_image->photo_name);
        $old_image->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
 
    }

    public function InactiveProduct($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0, 
        ]);

        $notification = array(
            'message' => 'Product Inactive Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
    }

    public function ActiveProduct($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1, 
        ]);

        $notification = array(
            'message' => 'Product Active Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        $product->delete();

        $images = MultiImage::where('product_id', $id)->get();
        foreach ($images as $img) {
           unlink($img->photo_name);
           $img->delete();
        }
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
    }
    

}

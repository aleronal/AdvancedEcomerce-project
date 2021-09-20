<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    public function BrandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([

            'brand_name_en' => 'required',
            'brand_name_es' => 'required',
            'brand_image' => 'required',

        ],[
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_es.required' => 'Input Brand Spanish Name'
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/'. $name_gen;

        Brand::insert([

            'brand_name_en' => $request->brand_name_en,
            'brand_name_es' => $request->brand_name_es,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_es' => str_replace(' ', '-', $request->brand_name_es),
            'brand_image' => $save_url,

        ]);

        $notification = array(
            'message'=> 'Brand Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        }

        public function BrandEdit($id)
        {
            $brand = Brand::findOrFail($id);
            return view('backend.brand.brand_edit', compact('brand'));
        }

        public function BrandUpdate(Request $request, $id)
        {
            // $brand = Brand::findOrFail($id);

            // if you use the hidden field it will be like followin 

            $brand_id = $request->id;
            
            $old_image = $request->old_image;

            if($request->file('brand_image'))
            {
      
        unlink($old_image);
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/'. $name_gen;
                
        

        Brand::findOrFail($brand_id)->update([
           
            'brand_name_en' => $request->brand_name_en,
            'brand_name_es' => $request->brand_name_es,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_es' => str_replace(' ', '-', $request->brand_name_es),
            'brand_image' => $save_url,
            
        ]);
        

        $notification = array(
            'message'=> 'Brand Updated with image Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.brand')->with($notification);

            }else{

                Brand::findOrFail($brand_id)->update([

                    'brand_name_en' => $request->brand_name_en,
                    'brand_name_es' => $request->brand_name_es,
                    'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                    'brand_slug_es' => str_replace(' ', '-', $request->brand_name_es),
                    
        
                ]);
        
                $notification = array(
                    'message'=> 'Brand Updated without image Succesfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.brand')->with($notification);
        

            }

        }

        public function BrandDelete($id)
        {
            $brand = Brand::findOrFail($id);
            unlink($brand->brand_image);
            $brand->delete();

            $notification = array(
                'message'=> 'Brand Deleted Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);


        }
}

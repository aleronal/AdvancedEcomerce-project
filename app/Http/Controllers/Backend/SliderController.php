<?php

namespace App\Http\Controllers\backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class SliderController extends Controller
{   
    public function ViewSlider()
    {
        $slider = Slider::latest()->get();
        return view('backend.slider.view_slider', compact('slider'));
    }

    public function StoreSlider(Request $request)
    {
        $request->validate([
            'slider_image' => 'required',

        ],[
            'slider_image.required' => '*Please Insert an Image*',
            
        ]);

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/'. $name_gen;

        Slider::insert([

            'slider_image' => $save_url,
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message'=> 'Slider Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function EditSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view ('backend.slider.edit_slider',compact('slider'));
    }

    public function UpdateSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

       $slider->update([
            'slider_image' => $request->old_image,
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'created_at' => Carbon::now(),

        ]);

        if($request->file('slider_image')){

            unlink($request->old_image);
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/'. $name_gen;
            

             $slider->update([
                'slider_image' => $save_url,
             ]);

        }

        $notification = array(
            'message'=> 'Slider Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.slider')->with($notification);
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        unlink($slider->slider_image);
        $slider->delete();

        $notification = array(
            'message'=> 'Slider Deleted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.slider')->with($notification);
    }

    public function ActiveSlider($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 1, 
        ]);

        $notification = array(
            'message' => 'Slider Activated Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
    }

    public function InactiveSlider($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 0, 
        ]);

        $notification = array(
            'message' => 'Slider Inactivated Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
    }
    
}

<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class SiteSettingController extends Controller
{
    public function SiteSetting()
    {
      $setting = SiteSetting::find(1);
      return view('backend.setting.update_setting',compact('setting'));

    }

    public function UpdateSiteSetting(Request $request, $id)
    {

      $setting_id = $id;

      $old_image = $request->old_image;

      if($request->file('logo'))
      {

      unlink($old_image);
      $image = $request->file('logo');
      $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      Image::make($image)->resize(139,36)->save('upload/logo/' . $name_gen);
      $save_url = 'upload/logo/'. $name_gen;
          
  

      SiteSetting::findOrFail($setting_id)->update([
     
      'phone_one' => $request->phone_one,
      'phone_two' => $request->phone_two,
      'email' => $request->email,
      'company_name' => $request->company_name,
      'company_address' => $request->company_address,
      'facebook' => $request->facebook,
      'twitter' => $request->twitter,
      'linkedIn' => $request->linkedIn,
      'youtube' => $request->youtube,
      'created_at' => Carbon::now(),
      
      'logo' => $save_url,
      
  ]);
  

  $notification = array(
      'message'=> 'Setting Updated with image Succesfully',
      'alert-type' => 'info'
  );
  return redirect()->back()->with($notification);

      }else{

          SiteSetting::findOrFail($setting_id)->update([

            'phone_one' => $request->phone_one,
            'phone_two' => $request->phone_two,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedIn' => $request->linkedIn,
            'youtube' => $request->youtube,
            'created_at' => Carbon::now(),
              
  
          ]);
  
          $notification = array(
              'message'=> 'Setting Updated without image Succesfully',
              'alert-type' => 'success'
          );
          return redirect()->back()->with($notification);
      }
    }

    public function SeoSetting()
    {
      $seo = Seo::findOrFail(1);

      return view('backend.setting.update_seo', compact('seo'));
    }
    
    public function UpdateSeoSetting(Request $request)
    {
      $seo = Seo::findOrFail(1);

      $seo->update([

        'meta_title' => $request->meta_title,
        'meta_author' => $request->meta_author,
        'meta_description' => $request->meta_description,
        'meta_keyword' => $request->meta_keyword,
        'google_analytics' => $request->google_analytics,
        'updated_at' => Carbon::now(),
        

      ]);

      $notification = array(
        'message'=> 'Seo Updated without image Succesfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

    }



}

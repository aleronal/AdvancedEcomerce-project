<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $subcategory = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_view', compact('subcategory','categories'));
    }

    public function SubCategoryStore(Request $request)
    {
       
            $request->validate([
    
                'subcategory_name_en' => 'required',
                'subcategory_name_es' => 'required',
                'category_id' => 'required',
    
            ],[
                'category_id.required' => 'Please select an option',
                'subcategory_name_en.required' => 'Input Subcategory English Name',
                'subcategory_name_es.required' => 'Input Subcategory Spanish Name'
            ]);
    
    
            SubCategory::insert([
    
                'category_id' => $request->category_id,
                'subcategory_name_en' => $request->subcategory_name_en,
                'subcategory_name_es' => $request->subcategory_name_es,
                'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
                'subcategory_slug_es' => str_replace(' ', '-', $request->subcategory_name_es),
                
         
    
            ]);
    
            $notification = array(
                'message'=> 'Subcategory Inserted Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
            
    }

    public function SubCategoryEdit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_edit', compact('subcategory','categories'));
    }

    public function SubCategoryUpdate(Request $request)
    {
        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
    
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_es' => $request->subcategory_name_es,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_es' => str_replace(' ', '-', $request->subcategory_name_es),
            
        ]);

        $notification = array(
            'message'=> 'Subcategory Updated Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.subcategory')->with($notification);

    }

    public function SubCategoryDelete($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        $notification = array(
            'message'=> 'Subcategory Deleted Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.subcategory')->with($notification);

    }

    // Sub Sub categories Methods

    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategory','categories'));
    }

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en','ASC')->get();

        return json_encode($subcat);
    }

    public function SubSubCategoryStore(Request $request)
    
    {
        $request->validate([
    
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_es' => 'required',

        ]);


        SubSubCategory::insert([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_es' => $request->subsubcategory_name_es,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_es' => str_replace(' ', '-', $request->subsubcategory_name_es),
            
     

        ]);

        $notification = array(
            'message'=> 'Sub - Subcategory Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        
}

    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);

        return view('backend.category.sub_subcategory_edit', compact('categories','subcategories', 'subsubcategories'));

    }

    public function SubSubCategoryUpdate(Request $request, $id)
    {
        $subsubcat_id = $id;

        SubSubCategory::findOrFail($subsubcat_id)->update([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_es' => $request->subsubcategory_name_es,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_es' => str_replace(' ', '-', $request->subsubcategory_name_es),
            
     

        ]);

        $notification = array(
            'message'=> 'Sub - Subcategory Updated Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.subsubcategory')->with($notification);

    }

    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message'=> 'Sub - Subcategory Deleted Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.subsubcategory')->with($notification);
    }


}

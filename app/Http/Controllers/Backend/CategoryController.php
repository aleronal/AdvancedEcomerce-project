<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate([

            'category_name_en' => 'required',
            'category_name_es' => 'required',
            'category_icon' => 'required',

        ],[
            'category_name_en.required' => 'Input category English Name',
            'category_name_es.required' => 'Input category Spanish Name'
        ]);


        Category::insert([

            'category_name_en' => $request->category_name_en,
            'category_name_es' => $request->category_name_es,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_es' => str_replace(' ', '-', $request->category_name_es),
            'category_icon' => $request->category_icon,
     

        ]);

        $notification = array(
            'message'=> 'category Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        }

        public function CategoryEdit($id)
        {
            $category = Category::findOrFail($id);
            return view('backend.category.category_edit', compact('category'));
        }

        public function CategoryUpdate(Request $request, $id)
        {
            $category = Category::findOrFail($id);
            {
                $request->validate([
        
                    'category_name_en' => 'required',
                    'category_name_es' => 'required',
                    'category_icon' => 'required',
        
                ],[
                    'category_name_en.required' => 'Input category English Name',
                    'category_name_es.required' => 'Input category Spanish Name'
                ]);
        
        
                $category->update([
        
                    'category_name_en' => $request->category_name_en,
                    'category_name_es' => $request->category_name_es,
                    'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                    'category_slug_es' => str_replace(' ', '-', $request->category_name_es),
                    'category_icon' => $request->category_icon,
                ]);

                $category->save();
        
                $notification = array(
                    'message'=> 'category Updated Succesfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.category')->with($notification);
        }
    }

    public function CategoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $notification = array(
            'message'=> 'category Deleted Succesfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('all.category')->with($notification);
    }
}

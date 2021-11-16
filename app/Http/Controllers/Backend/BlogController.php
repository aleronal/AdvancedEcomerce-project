<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPost;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use Intervention\Image\Facades\Image;
use App\Models\BlogPost as ModelsBlogPost;

class BlogController extends Controller
{
    public function BlogCategory()
    {
        $blogCategory = BlogPostCategory::latest()->get();

        return view('backend.blog.category.view_category', compact('blogCategory'));
    }

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([

            'blog_category_name_en' => 'required',
            'blog_category_name_es' => 'required',
            

        ],[
            'blog_category_name_en.required' => 'Input category English Name',
            'blog_category_name_es.required' => 'Input category Spanish Name'
        ]);


        BlogPostCategory::insert([

            'blog_category_name_en' => ucfirst($request->blog_category_name_en),
            'blog_category_name_es' => ucfirst($request->blog_category_name_es),
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'blog_category_slug_es' => strtolower(str_replace(' ', '-', $request->blog_category_name_es)),
            'created_at' => Carbon::now(),
           
     

        ]);

        $notification = array(
            'message'=> 'Blog Category Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);

        return view('backend.blog.category.edit_category', compact('blogCategory'));
    }

    public function UpdateBlogCategory(Request $request, $id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);

        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_es' => 'required',
        ]);

        $blogCategory->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_es' => $request->blog_category_name_es,
        ]);

        $notification = array(
            'message'=> 'Blog Category Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog-category')->with($notification);
    }

    public function DeleteBlogCategory($id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);

        $blogCategory->delete();

        $notification = array(
            'message'=> 'Blog Category Deleted Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog-category')->with($notification);
    }

    public function AddPost()
    {
        $blogPost = BlogPost::latest()->get();
        $blogCategory = BlogPostCategory::latest()->get();

        return view('backend.blog.post.add_post',compact('blogPost','blogCategory'));
    }

    public function ViewPost()
    {
        $blogPost = BlogPost::with('category')->latest()->get();
        
        return view('backend.blog.post.view_post',compact('blogPost'));
    }

    public function StorePost(Request $request)
    {

        $request->validate([
            'post_title_en' => 'required',
            'post_title_es' => 'required',
            'category_id' =>'required',
            'post_details_en' => 'required',
            'post_details_es' => 'required'
        ]);

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
        $save_url ='upload/post/'.$name_gen;

        BlogPost::insert([

            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_title_es' => $request->post_title_es,
            'post_image' => $save_url,
            'post_slug_en' => $request->post_title_en,
            'post_slug_es' => $request->post_title_es,
            'post_details_en' => $request->post_details_en,
            'post_details_es' => $request->post_title_es,
            'created_at' => Carbon::now()

        ]);

        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('view-post')->with($notification);

    }

}

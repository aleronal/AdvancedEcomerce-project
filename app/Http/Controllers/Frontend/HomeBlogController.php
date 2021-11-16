<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    public function BlogPosts()
    {
        $blog_post = BlogPost::latest()->get();
        $blog_post_category = BlogPostCategory::get();

        return view('frontend.blog.blog_list', compact('blog_post', 'blog_post_category'));
    }

    public function BlogPostDetails($id)
    {

        $blog_post = BlogPost::findOrFail($id);
        $blog_post_category = BlogPostCategory::get();

        return view('frontend.blog.details_blog',compact('blog_post','blog_post_category'));

    }

    public function HomeBlogCatPost($category_id)
    {
        $blog_post = BlogPost::where('category_id', $category_id)->orderBy('id', 'ASC')->get();
        $blog_post_category = BlogPostCategory::latest()->get();

        return view('frontend.blog.cat_list_blog',compact('blog_post','blog_post_category'));
    }
}

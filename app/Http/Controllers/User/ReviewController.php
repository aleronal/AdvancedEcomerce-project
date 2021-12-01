<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        $product_id = $request->product_id;

        $request->validate([
            'summary' => 'required',
            'comment' => 'required',

        ]);

        Review::insert([

            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message' => 'Review Added Successfully(will be reviewd by admin)',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PendingReview()
    {

        $reviews = Review::where('status', 0)->orderBy('id', 'ASC')->get();

        return view('backend.review.pending_review',compact('reviews'));

    }

    public function ApproveReview($id)
    {
        $review = Review::findOrFail($id);

        $review->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllReviewsApproved()
    {
        $reviews = Review::where('status', '1')->orderBy('id','DESC')->get();

        return view('backend.review.approved_review', compact('reviews'));

    }

    public function DeleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}

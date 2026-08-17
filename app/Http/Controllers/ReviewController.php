<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceRequestModel;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
    public function add_review(Request $request, $id)
    {
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Check Service Request
        $serviceRequest = ServiceRequestModel::find($id);

        if (!$serviceRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Service request not found.'
            ], 404);
        }

        // Check request belongs to logged in user
        if ($serviceRequest->user_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }

        // Prevent duplicate review
        $alreadyReviewed = ReviewModel::where('request_id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if ($alreadyReviewed) {
            return response()->json([
                'success' => false,
                'message' => 'Review already submitted.'
            ], 409);
        }

        $review = ReviewModel::create([
            'request_id'  => $serviceRequest->id,
            'customer_id' => $user->id,
            'vendor_id'   => $serviceRequest->vendor_id,
            'rating'      => $request->rating,
            'review'      => $request->review,
        ]);
        $serviceRequest->update(['review_status' => '1']);

        return response()->json([
            'success' => true,
            'message' => 'Review added successfully.',
            'data'    => $review
        ], 201);
    }
    public function edit_review(Request $request, $id)
    {
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $review = ReviewModel::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found.'
            ], 404);
        }

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully.',
            'data' => $review
        ], 200);
    }
    public function review_details($id)
    {
        $user = auth('api')->user();

        $review = ReviewModel::with(['user', 'vendor', 'serviceRequest'])
            ->where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Review Details',
            'data' => $review
        ], 200);
    }
    public function my_reviews()
    {
        $user = auth('api')->user();

        $reviews = ReviewModel::with(['vendor', 'serviceRequest'])
            ->where('customer_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'My Reviews',
            'data' => $reviews
        ], 200);
    }

    public function delete_review($id)
    {
        $user = auth('api')->user();

        $review = ReviewModel::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found.'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully.'
        ], 200);
    }


    public function review_list_vendor()
    {
        $vendor = auth('vendor')->user();

        $reviews = ReviewModel::with([
            'user',
            'serviceRequest'
        ])
            ->where('vendor_id', $vendor->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Review List',
            'data' => $reviews
        ], 200);
    }


    public function review_details_vendor($id)
    {
        $vendor = auth('vendor')->user();

        $review = ReviewModel::with([
            'user',
            'serviceRequest'
        ])
            ->where('id', $id)
            ->where('vendor_id', $vendor->id)
            ->first();

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Review Details',
            'data' => $review
        ], 200);
    }

    public function adminReviewsList(Request $request)
    {
        $query = ReviewModel::with(['user', 'vendor', 'serviceRequest.subCategory', 'serviceRequest.category']);

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('review', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('user', function ($u) use ($keyword) {
                      $u->where('name', 'LIKE', "%{$keyword}%")->orWhere('phone', 'LIKE', "%{$keyword}%");
                  })
                  ->orWhereHas('vendor', function ($v) use ($keyword) {
                      $v->where('name', 'LIKE', "%{$keyword}%")->orWhere('phone', 'LIKE', "%{$keyword}%");
                  });
            });
        }

        $reviews = $query->latest()->paginate(15)->withQueryString();

        $avgRating = ReviewModel::avg('rating') ?? 0;
        $totalReviews = ReviewModel::count();
        $fiveStarCount = ReviewModel::where('rating', 5)->count();
        $oneStarCount = ReviewModel::where('rating', 1)->count();

        return view('reviewsList', compact('reviews', 'avgRating', 'totalReviews', 'fiveStarCount', 'oneStarCount'));
    }

    public function adminToggleReviewStatus($id)
    {
        $review = ReviewModel::findOrFail($id);
        $review->status = ($review->status == 1) ? 0 : 1;
        $review->save();

        $msg = $review->status == 1 ? 'Review published on mobile app.' : 'Review hidden from mobile app.';
        return redirect()->back()->with('success', $msg);
    }

    public function adminDeleteReview($id)
    {
        $review = ReviewModel::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}

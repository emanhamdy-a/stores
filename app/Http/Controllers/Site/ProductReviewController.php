<?php

namespace App\Http\Controllers\Site;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ProductReviewController extends Controller
{

  public function store(ReviewRequest $request)
  {

    try {
      DB::beginTransaction();

      $Product_slug = Product::where('id',$request->product_id)->first()->slug;
      $review = Review::where('product_id',$request->product_id)
      ->where('user_id',$request->user_id)->first();

      if(!$review){
        Review::create([
          'user_id'   => $request->user_id,
          'product_id'=> $request->product_id,
          'review'    => $request->review,
          'title'     => $request->title,
          'content'   => $request->content,
        ]);
      }else{
        $review -> review     = $request->review;
        $review -> title      = $request->title;
        $review -> content    = $request->content;
        $review->save();
      }

      DB::commit();

      return redirect()->route('product.details',$Product_slug)
       ->with(['success' => __('front\reviews.added')]);
      } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->route('product.details',$Product_slug)
        ->with(['error' => __('front\reviews.error try later')]);
    }
  }
}

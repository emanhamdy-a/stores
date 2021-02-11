<?php


namespace App\Repositories;
use App\Models\Review;
use App\Http\Interfaces\ReviewsRepositoryInterface;

class ReviewsRepository implements ReviewsRepositoryInterface
{

  /**
   * get product attributes
   */
  public function createReview($request)
  {

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

  }

}

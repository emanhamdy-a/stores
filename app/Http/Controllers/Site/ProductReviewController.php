<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Repositories\ReviewsRepository;

class ProductReviewController extends Controller
{

  protected $repository;

  public function __construct(ReviewsRepository $repository)
  {
    $this->repository = $repository;
  }

  public function store(ReviewRequest $request)
  {

    try {
      DB::beginTransaction();

      $this->repository->createReview($request);

      $Product_slug = Product::where('id',$request->product_id)->first()->slug;

      DB::commit();

      return redirect()->route('product.details',$Product_slug)
       ->with(['success' => __('front/reviews.added')]);

      } catch (\Throwable $th) {
        DB::rollback();
        $Product_slug = Product::where('id',$request->product_id)->first()->slug;
        return redirect()->route('product.details',$Product_slug)
        ->with(['error' => __('front/reviews.error try later')]);
    }
  }
}

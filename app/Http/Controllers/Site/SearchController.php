<?php

namespace App\Http\Controllers\Site;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SearchRepository;

class SearchController extends Controller
{

  protected $repository;

  public function __construct(SearchRepository $repository)
  {
    $this->repository = $repository;
  }

  public function search(Request $request)
  {

    $products=$this->repository->search($request);

    if(request()->ajax()) {
      return view('front.search',compact('products'))->renderSections()['content'];
    }

    return view('front.search',[
      'products'=> $products
    ]);

  }
}

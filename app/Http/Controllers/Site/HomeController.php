<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\HomeRepository;

class HomeController extends Controller
{

  protected $repository;

  public function __construct(HomeRepository $repository)
  {
    $this->repository = $repository;
  }

  public function home()
  {
    $data = [];

    $data['sliders'] = $this->repository->getMainSlider();

    $data['flash_deal'] = $this->repository->getFlashDeal();

    $data['newProducts'] = $this->repository->newProducts();

    $data['trendes'] = $this->repository->Trends();

    $data['bestSellers'] = $this->repository->bestSellers();

    $data['main_categories_products'] = $this->repository->mainCategoriesProdcuts();

    return view('front.home', $data);

  }
}

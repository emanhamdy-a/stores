<?php


namespace App\Http\Interfaces;

interface HomeRepositoryInterface
{

  /**
   * get main slider
   */
  public function getMainSlider();

  /**
   * get flash deal
   */
  public function getFlashDeal();

  /**
   * get new products
   */
  public function newProducts();

  /**
   * get trends products
   */
  public function Trends();

  /**
   * get best sellers
   */
  public function bestSellers();

  /**
   * get main categories for products
   */
  public function mainCategoriesProdcuts();

}

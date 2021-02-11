<?php


namespace App\Http\Interfaces;

interface SearchRepositoryInterface
{

  /*
   * get search results
   */
  public function search($request);

}

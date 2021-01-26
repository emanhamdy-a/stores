<?php


namespace App\Http\Interfaces;


interface ProcuctRepositoryInterface
{
  /**
   * get all products
   */
  public function all();

  /**
   * go to create product page
   */
  public function create();

  /**
   * save new product data
   */
  public function store(array $data);

  /**
   * go to edit product data
   */
  public function edit($id);

  /**
   * update product data
   */
  public function update(array $data, $record);

  /**
   * sho product data
   */
  public function show($id);

  /**
   * delete product
   */
  public function delete($product,$id);

  /**
   * save product price details
   */
  public function savePrice($request);

  /**
   * save product stock details
   */
  public function saveStock($request);

  /**
   * if request has is active add is active = 1
   */
  public function is_active($request);

  /**
   * if request has lang set locale to this lang
   */
  public function setlocale($request);
}

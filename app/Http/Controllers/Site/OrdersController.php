<?php

namespace App\Http\Controllers\Site;

class OrdersController
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $orders =  auth()->user()->orders;
    return view('front.orders', compact('orders'));
  }

}

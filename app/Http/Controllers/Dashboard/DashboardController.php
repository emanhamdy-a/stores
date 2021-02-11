<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data=[];
    $data['products']  = Product::latest()->take(30)->get();
    $data['orders']    = Order::latest()->take(30)->get();
    $data['ordern']    = Order::count();
    $data['categoryn'] = Category::count();
    $data['brandn']    = Brand::count();
    $data['productn']  = Product::count();
    $data['adminn']    = Admin::count();

    return view('dashboard.index',$data);

  }

}

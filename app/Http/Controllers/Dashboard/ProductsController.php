<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductStockRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductPriceValidation;

class ProductsController extends Controller
{

  protected $repository;

  public function __construct(ProductRepository $repository)
  {
    $this->repository = $repository;
  }

  //get products
  public function index()
  {
    $products = $this->repository->all();
    return view('dashboard.products.general.index', compact('products'));
  }
  // go to create general data page
  public function create()
  {
    $data = $this->repository->create();
    return view('dashboard.products.general.create', $data);
  }

  // save general data
  public function store(GeneralProductRequest $request)
  {
    try{

      DB::beginTransaction();

      $this->repository->store($request);

      DB::commit();

      return redirect()->route('admin.products')->with([
        'success' => __('admin/products.product added')
      ]);
    }catch(\Exception $ex){
      DB::rollback();
      return redirect()->route('admin.products')->with([
        'error' => __('admin/products.try later')
      ]);
    }
  }

  // go to update general data page
  public function edit($id)
  {
    $product = Product::findOrFail($id);

    if (!$product)
    return redirect()->route('admin.products')
    ->with(['error' => __('admin/products.not found')]);

    $data = $this->repository->edit($product);

    return view('dashboard.products.general.edit',$data);
  }

  // update general data
  public function update($id, GeneralProductRequest $request)
  {
    try{
      DB::beginTransaction();

      $this->repository->update($request);

      DB::commit();
      return redirect()->route('admin.products')->with([
        'success' => __('admin/products.product updated')]);

    }catch(\Exeption $ex){
      DB::rollback();
      return redirect()->route('admin.products')->with([
        'error' => __('admin/products.try later')
      ]);
    }
  }

  // go to manage price page
  public function getPrice($product_id){

    return view('dashboard.products.prices.create') -> with('id',$product_id) ;
  }

  // save product price data
  public function saveProductPrice(ProductPriceValidation $request){

    try{

      $this->repository->savePrice($request);

      return redirect()->route('admin.products')->with([
        'success' =>  __('admin/products.product updated')]);

    }catch(\Exeption $ex){
      DB::rollback();
      return redirect()->route('admin.products')->with([
        'error' => __('admin/products.try later')
      ]);
    }
  }

  // go to manage price page
  public function getStock($product_id){

    return view('dashboard.products.stock.create') -> with('id',$product_id) ;
  }

  // save manage price data
  public function saveProductStock (ProductStockRequest $request){

    try{

      $this->repository->saveStock($request);

      return redirect()->route('admin.products')->with([
        'success' =>  __('admin/products.product updated')]);

    }catch(\Exeption $ex){
      DB::rollback();
      return redirect()->route('admin.products')->with([
        'error' => __('admin/products.try later')
      ]);
    }

  }

  // go to add images page
  public function addImages($product_id){
    return view('dashboard.products.images.create')->withId($product_id);
  }

  //to save images to folder only
  public function saveProductImages(Request $request ){

    $file = $request->file('dzfile');
    $filename = uploadImage('products', $file);

    return response()->json([
      'name' => $filename,
      'original_name' => $file->getClientOriginalName(),
    ]);

  }

  //to save images to db
  public function saveProductImagesDB(ProductImagesRequest $request){

    try {
      // save dropzone images
      if ($request->has('document') && count($request->document) > 0) {
        foreach ($request->document as $image) {
          Image::create([
            'product_id' => $request->product_id,
            'photo' => $image,
          ]);
        }
      }

      return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

    }catch(\Exception $ex){

    }
  }

  public function destroy($id)
  {
    try {
      $product = Product::findOrFail($id);

      if (!$product)
        return redirect()->route('admin.products')->with([
          'error' => __('admin/product.not found')]);

      $this->repository->delete($product,$id);

      return redirect()->route('admin.products')->with([
        'success' => __('admin/product.product deleted')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.products')->with([
        'error' => __('admin/product.try later')]);
    }
  }
}

<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\PhotoableTrait;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductStockRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductPriceValidation;

class ProductsController extends Controller
{
  use PhotoableTrait;
  protected $repository;

  public function __construct(ProductRepository $repository)
  {
    $this->repository = $repository;
    $this->disc='products';
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
      if ($request->has('image')){
        $data=$this->move_to_folder($request->image);
        $request->request->add(['main_image' => $data['hashname']]);
      }

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
  public function update($id,GeneralProductRequest $request)
  {
    try{
      $product=Product::findOrFail($id);
      DB::beginTransaction();
      if ($request->has('image')){
        $data=$this->move_to_folder($request->image);
        $request->request->add(['main_image' => $data['hashname']]);
        $this->unlinkimage($product->main_image);
      }
      DB::commit();
      $this->repository->update($id,$request);

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
  public function addImages($product){
    $product=Product::findOrFail($product);
    return view('dashboard.products.images.create',compact('product'));
  }

  // save images to folder
  public function saveProductImages(Request $request,$product_id ){
    $file = $request->file('dzfile');
    //move to folder
    $data = $this->move_to_folder($file);
    //store to db
    $fid  = $this->storeImages($data['hashname'],$product_id);
    return response()->json([
      'status' =>200,
      'msg' => __('admin/image.uploded'),
      'fid' => $fid,
      'name' => $data['hashname'],
      'original_name' => $data['name'],
    ]);

  }

  //to save images to db
  public function saveProductImagesDB(ProductImagesRequest $request){
    try {
      // save dropzone images
      if ($request->has('document') && count($request->document) > 0) {
        foreach ($request->document as $image) {
          $this->storeImages($image,$request->product_id);
        }
      }

      return redirect()->route('admin.products')->with([
        'success' =>__('admin/products.product updated')
      ]);

    }catch(\Exception $ex){
      return redirect()->route('admin.products')->with([
        'error' =>__('admin/products.try later')
      ]);
    }
  }
  /**
   * delete product
   */
  public function destroy($id)
  {
    try {
      $product = Product::findOrFail($id);

      if (!$product)
        return redirect()->route('admin.products')->with([
          'error' => __('admin/product.not found')]);

      $this->deleteimages($id);
      $this->unlinkimage($product->main_image);
      $this->repository->delete($product,$id);

      return redirect()->route('admin.products')->with([
        'success' => __('admin/product.product deleted')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.products')->with([
        'error' => __('admin/product.try later')]);
    }
  }
  /**
   * save images to db
   */
  public function storeImages($image,$id){
    if(!Image::where('photo',$image)->first()){
      $newimage=Image::create([
        'product_id' => $id,
        'photo' => $image,
      ]);
      return $newimage->id;
    }
  }
  /**
   * delete product images
   */
  public function deleteimages($productId){
    if($product=Product::findOrFail($productId)){
      if(!empty($product->images)){
        foreach($product->images as $image){
          $filename=$image->photo;
          // delete image from folder
          $this->unlinkimage($filename);
          // delete image from database
          Image::where('photo',$filename)->delete();
        }
      }
    }
  }
  /**
   * delete on image
   */
  public function deleteImage(Request $request){
    $image=Image::findOrFail($request->id);
    // delete image from folder
    $this->unlinkimage($image->photo);
    // delete image from database
    Image::where('photo',$image->photo)->delete();
    return response()->json([
      'status' => 200,
      'msg' => _('admin/image.deleted'),
    ]);
  }
}

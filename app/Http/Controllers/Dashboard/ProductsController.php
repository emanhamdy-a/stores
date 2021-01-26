<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UploadImage\ProductImageStore;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductStockRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductPriceValidation;

class ProductsController extends Controller
{
  protected $repository;
  protected $upload;

  public function __construct(ProductRepository $repository,ProductImageStore $upload)
  {
    $this->repository = $repository;
    $this->upload     = $upload;
    $this->upload->disc       ='products';
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
        $data=$this->upload->move_to_folder($request->image);
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
        $data=$this->upload->move_to_folder($request->image);
        $request->request->add(['main_image' => $data['hashname']]);
        $this->upload->unlinkimage($product->main_image);
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

  // move to folder and save images to db
  public function saveProductImages(ProductImagesRequest $request,$product_id ){
    $file = $request->file('dzfile');
    //move to folder
    $data = $this->upload->move_to_folder($file);
    //store to db
    $fid  = $this->upload->storeImages($data['hashname'],$product_id);
    return response()->json([
      'status' =>200,
      'msg' => __('admin/image.uploaded'),
      'fid' => $fid,
      'name' => $data['hashname'],
      'original_name' => $data['name'],
    ]);
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

      $this->upload->deleteimages($id);
      $this->upload->unlinkimage($product->main_image);
      $this->repository->delete($product,$id);

      return redirect()->route('admin.products')->with([
        'success' => __('admin/product.product deleted')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.products')->with([
        'error' => __('admin/product.try later')]);
    }
  }

  /**
   * delete on image
   */
  public function deleteImage(Request $request){
    return $this->upload->deleteimage($request);
  }
}

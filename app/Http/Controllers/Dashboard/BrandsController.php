<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Brand;
use App\Models\Picture;
use App\Traits\PhotoableTrait;
use App\Repositories\Repository;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
  use PhotoableTrait;
  protected $repository;

  public function __construct(Brand $brand)
  {
    $this->repository   = new Repository($brand);
    $this->disc='brands';
  }

  public function index()
  {
    $brands=$this->repository->all();
    return view('dashboard.brands.index', compact('brands'));
  }

  public function create()
  {
    return view('dashboard.brands.create');
  }


  public function store(BrandRequest $request)
  {

    try{
      DB::beginTransaction();

      //add to request if is active
      $this->repository->is_active($request);

      $brand=$this->repository->create($request->except('_token', 'photo'));

      //save translations
      $brand->name = $request->name;

      $brand->save();

      if($brand->save() && $request->has('image')){
        $this->storeimage($request->image,$brand->id);
      }

      DB::commit();
      return redirect()->route('admin.brands')->with([
        'success' =>  __('admin/brands.created')]);
    } catch (\Exception $ex) {
      DB::rollback();
      return redirect()->route('admin.brands')->with([
        'error' => __('admin/brands.error try later')]);
    }

  }


  public function edit($id)
  {
    $brand = Brand::find($id);
    if (!$brand)
      return redirect()->route('admin.brands')->with(['error' => 'هذا الماركة غير موجود ']);
    return view('dashboard.brands.edit', compact('brand'));
  }


  public function update($id, BrandRequest $request)
  {
    try {

      $brand = Brand::find($id);

      if (!$brand)
        return redirect()->route('admin.brands')->with(['error' =>  __('admin/brands.not found')]);

      DB::beginTransaction();

      $this->repository->is_active($request);

      $this->repository->update($request->all(),$brand);

      $brand->name = $request->name;

      if($brand->save()){

        if($request->has('image')){
          $this->storeimage($request->image,$brand->id);
          $this->deleteimage($brand);
        }

      }

      DB::commit();
      return redirect()->route('admin.brands')->with([
        'success' => __('admin/brands.updated')
      ]);

    } catch (\Exception $ex) {

      DB::rollback();
      return redirect()->route('admin.brands')->with([
        'error' => __('admin/brands.error try later')]);
    }

  }


  public function destroy($id)
  {
    try {
      $brand = Brand::find($id);

      if (!$brand)
        return redirect()->route('admin.brands')->with([
          'error' =>   __('admin/brands.not found')
        ]);

      if($this->deleteimage($brand)){
        $brand->delete();
      }

      return redirect()->route('admin.brands')->with([
        'success' =>  __('admin/brands.deleted')
      ]);
    } catch (\Exception $ex) {
      return redirect()->route('admin.brands')->with([
        'error' =>  __('admin/brands.error try later')
      ]);
    }
  }

  public function storeimage($request_image,$id){
    if($storeas= $this->move_to_folder($request_image)){
      $data=[
        'pictureable_id'  =>$id,
        'pictureable_type'=>'App\Models\Brand',
        'filename'      =>$storeas['hashname'],
      ];
      Picture::create($data);
    }
  }

  public function deleteimage($brand){
    if(!empty($brand->picture->filename)){
        $filename=$brand->picture->filename;
      // delete image from database
      if($brand->picture->delete()){
        // delete image from path
        $this->unlinkimage($filename);
        return true;
      }
    }
    return false;
  }

}

<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Attribute;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;

class AttributesController extends Controller
{
  protected $repository;

  public function __construct(Attribute $attribute)
  {
    $this->repository   = new Repository($attribute);
  }

  public function index()
  {
    $attributes = $this->repository->all();
    return view('dashboard.attributes.index', compact('attributes'));
  }

  public function create()
  {
    return view('dashboard.attributes.create');
  }


  public function store(AttributeRequest $request)
  {

    try{

      DB::beginTransaction();

      $attribute =$this->repository->create($request->except('_token'));

      $attribute->name = $request->name;
      $attribute->save();

      DB::commit();
      return redirect()->route('admin.attributes')->with([
        'success' => __('admin/attributes.created')]);

    }catch (\Exception $ex) {
      DB::rollback();
      return redirect()->route('admin.attributes')->with(['success' =>  __('admin/attributes.error try later')]);
    }

  }


  public function edit($id)
  {

    $attribute = Attribute::find($id);

    if (!$attribute)
    return redirect()->route('admin.attributes')->with(['error' =>  __('admin/attributes.not found')]);

    return view('dashboard.attributes.edit', compact('attribute'));

  }


  public function update($id, AttributeRequest $request)
  {
    try {

      $attribute = Attribute::find($id);

      if (!$attribute)
        return redirect()->route('admin.attributes')->with(['error' => __('admin/attributes.not found')]);

      DB::beginTransaction();

      $attribute =$this->repository->update($request->all(),$attribute);

      //save translations
      $attribute->name = $request->name;
      $attribute->save();

      DB::commit();
      return redirect()->route('admin.attributes')->with(['success' => __('admin/attributes.updated')]);

    } catch (\Exception $ex) {

      DB::rollback();
      return redirect()->route('admin.attributes')->with(['error' => __('admin/attributes.error try later')]);
    }

  }


  public function destroy($id)
  {
    try {
      //get specific attributes and its translations
      $attributes = Attribute::find($id);

      if (!$attributes)
        return redirect()->route('admin.attributes')->with(['error' =>__('admin/attributes.not found')]);

      $attributes->delete();

      return redirect()->route('admin.attributes')->with(['success' =>__('admin/attributes.deleted')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.attributes')->with(['error' => __('admin/attributes.error try later')]);
    }
  }

}

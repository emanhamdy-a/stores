<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use App\Models\Option;
use App\Models\Product;
use App\Models\Attribute;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;

class OptionsController extends Controller
{

  protected $repository;

  public function __construct(Option $option)
  {
    $this->repository   = new Repository($option);
  }
  public function index()
  {
    $options = $this->repository->all();
    return view('dashboard.options.index', compact('options'));
  }

  public function create()
  {
    $data = [];
    $data['products'] = Product::active()->select('id')->get();
    $data['attributes'] = Attribute::select('id')->get();

    return view('dashboard.options.create', $data);
  }

  public function store(OptionsRequest $request)
  {


    try{
      DB::beginTransaction();

      $option =$this->repository->create($request->except('_token'));

      $option->name = $request->name;
      $option->save();

      DB::commit();
      return redirect()->route('admin.options')->with([
        'success' => __('admin/options.created')]);
    }catch (\Exception $ex) {
      DB::rollback();
      return redirect()->route('admin.options')->with(['error' =>  __('admin/options.error try later')]);
    }


  }

  public function edit($optionId)
  {

    $data = [];
     $data['option'] = Option::find($optionId);

    if (!$data['option'])
      return redirect()->route('admin.options')->with([
        'error' =>__('admin/options.not found')]);

    $data['products'] = Product::active()->select('id')->get();
    $data['attributes'] = Attribute::select('id')->get();

    return view('dashboard.options.edit', $data);

  }

  public function update($id, OptionsRequest $request)
  {
    try {

      $option = Option::find($id);

     if (!$option)
       return redirect()->route('admin.options')->with(['error' => __('admin/options.not found')]);

     DB::beginTransaction();

     $option =$this->repository->update($request->all(),$option);

     //save translations
     $option->name = $request->name;
     $option->save();

     DB::commit();
     return redirect()->route('admin.options')->with(['success' => __('admin/options.updated')]);

    } catch (\Exception $ex) {

      DB::rollback();
      return redirect()->route('admin.options')->with(['error' => __('admin/options.error try later')]);
    }

  }


  public function destroy($id)
  {
    try {
      $option = Option::findOrFail($id);

      if (!$option)
        return redirect()->route('admin.options')->with(['error' =>__('admin/options.not found')]);

      $option->delete();

      return redirect()->route('admin.options')->with(['success' =>__('admin/options.deleted')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.options')->with(['error' => __('admin/options.error try later')]);
    }
  }

}

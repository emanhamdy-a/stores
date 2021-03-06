<?php
namespace App\Http\Controllers\Dashboard;
use DB;
use App\Models\Picture;
use App\Models\Category;
use App\Traits\PhotoableTrait;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;

class MainCategoriesController extends Controller
{
  use PhotoableTrait;
  protected $repository;

  public function __construct(Category $category)
  {
    $this->repository   = new Repository($category);
    $this->disc='categories';
  }

  public function index()
  {
    $categories=$this->repository->all();
    return view('dashboard.categories.index', compact('categories'));
  }

  public function create()
  {
     $categories =   Category::select('id','parent_id')->get();
    return view('dashboard.categories.create',compact('categories'));
  }

  public function store(MainCategoryRequest $request)
  {

    try {

      DB::beginTransaction();

      //add to request if is active
      $this->repository->is_active($request);

      if($request -> type == 1 && CategoryType::mainCategory)
      {
        $request->request->add(['parent_id' => null]);
      }

      $category =$this->repository->create($request->except('_token'));

      $category->name = $request->name;

      if($category->save() && $request->has('image')){
        $this->storeimage($request->image,$category->id);
      }

      DB::commit();

      return redirect()->route('admin.maincategories')->with([
        'success' => __('admin/categories.created')]);

    } catch (\Exception $ex) {
       DB::rollback();
      return redirect()->route('admin.maincategories')->with([
        'error' => __('admin/categories.error try later')]);
    }

  }

  public function edit($id)
  {
    $category = Category::orderBy('id', 'DESC')->find($id);

    if (!$category)
      return redirect()->route('admin.maincategories')->with([
        'error' => __('admin/categories.not found')]);

    return view('dashboard.categories.edit', compact('category'));
  }

  public function update(MainCategoryRequest $request,$id)
  {
    try {

      DB::beginTransaction();

      $category = Category::find($id);
      if (!$category)
        return redirect()->route('admin.maincategories')->with([
          'error' => __('admin/categories.not found') ]);

      $this->repository->is_active($request);

      if($request -> type == 1 && CategoryType::mainCategory)
      {
        $request->request->add(['parent_id' => null]);
      }

      $this->repository->update($request->all(),$category);

      $category->name = $request->name;

      if($category->save()){

        if($request->has('image')){
          $this->storeimage($request->image,$category->id);
          $this->deleteimage($category);
        }

      }

      DB::commit();

      return redirect()->route('admin.maincategories')->with([
        'success' => __('admin/categories.updated')]);

    } catch (\Exception $ex) {

      DB::rollback();

      return redirect()->route('admin.maincategories')->with([
        'error' => __('admin/categories.error try later')]);
    }

  }

  public function destroy($id)
  {

    try {

      $category = Category::find($id);

      if (!$category)
        return redirect()->route('admin.maincategories')
          ->with(['error' => __('admin/categories.not found')]);

      $this->deleteimage($category);

      // delete category
      $category->delete();

      return redirect()->route('admin.maincategories')
        ->with(['success' => __('admin/categories.deleted')]);

    } catch (\Exception $ex) {
      return $ex;
      return redirect()->route('admin.maincategories')
        ->with(['error' => __('admin/categories.error try later')]);
    }
  }

  public function storeimage($request_image,$id){
    if($storeas= $this->move_to_folder($request_image)){
      $data=[
        'pictureable_id'  =>$id,
        'pictureable_type'=>'App\Models\Category',
        'filename'      =>$storeas['hashname'],
      ];
      Picture::create($data);
    }
  }

  public function deleteimage($category){
    if(!empty($category->picture->filename)){

      $filename=$category->picture->filename;
      // delete image from database
      if($category->picture->delete()){
        // delete image from path
        $this->unlinkimage($filename);
      }

    }
  }

}

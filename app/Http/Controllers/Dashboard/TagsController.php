<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use DB;

class TagsController extends Controller
{

  protected $repository;

  public function __construct(Tag $tag)
  {
    $this->repository   = new Repository($tag);
  }

  public function index()
  {
    $tags = $this->repository->all();
    return view('dashboard.tags.index', compact('tags'));
  }

  public function create()
  {
    return view('dashboard.tags.create');
  }


  public function store(TagsRequest $request)
  {

    try{
      DB::beginTransaction();

      $tag =$this->repository->create($request->except('_token'));

      $tag->name = $request->name;
      $tag->save();

      DB::commit();
      return redirect()->route('admin.tags')->with([
        'success' => __('admin/tags.created')]);
    }catch (\Exception $ex) {
      DB::rollback();
      return redirect()->route('admin.tags')->with(['error' =>  __('admin/tags.error try later')]);
    }

  }


  public function edit($id)
  {

    $tag = Tag::find($id);

    if (!$tag)
      return redirect()->route('admin.tags')->with(['error' =>  __('admin/tags.not found')]);

    return view('dashboard.tags.edit', compact('tag'));

  }


  public function update($id, TagsRequest  $request)
  {
    try {

       $tag = Tag::find($id);

      if (!$tag)
        return redirect()->route('admin.tags')->with(['error' => __('admin/tags.not found')]);

      DB::beginTransaction();

      $tag =$this->repository->update($request->all(),$tag);

      //save translations
      $tag->name = $request->name;
      $tag->save();

      DB::commit();
      return redirect()->route('admin.tags')->with(['success' => __('admin/tags.updated')]);

    } catch (\Exception $ex) {

      DB::rollback();
      return redirect()->route('admin.tags')->with(['error' => __('admin/tags.error try later')]);
    }

  }


  public function destroy($id)
  {
    try {
      //get specific tags and its translations
      $tags = Tag::find($id);

      if (!$tags)
        return redirect()->route('admin.tags')->with(['error' =>__('admin/tags.not found')]);

      $tags->delete();

      return redirect()->route('admin.tags')->with(['success' =>__('admin/tags.deleted')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.tags')->with(['error' => __('admin/tags.error try later')]);
    }
  }

}

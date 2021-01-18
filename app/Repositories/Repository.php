<?php


namespace App\Repositories;
use \App\Http\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
      $this->model = $model;
    }

    public function all()
    {
      return $this->model->all();
    }

    public function create(array $request)
    {
      // set local
      if( array_key_exists('lang',$request)){
        app()->setLocale($request['lang']);
      }
      return $this->model->create($request);
    }

    public function update(array $request, $record)
    {
      // set local
      if( array_key_exists('lang',$request)){
        app()->setLocale($request['lang']);
      }
      $record->update($request);
      return $record;
    }

    public function delete($id)
    {
      return $this->model->destroy($id);
    }

    public function show($id)
    {
      return $this->model-findOrFail($id);
    }

    // add to request if is active
    public function is_active($request){
      if (!$request->has('is_active'))
          $request->request->add(['is_active' => '0']);
      else
        $request->request->add(['is_active' => '1']);
    }

    //if request has lang set locale to this lang
    public function setlocale($request){
      if (!$request->has('image')){
        app()->setLocale($request->lang);
      }
    }
}

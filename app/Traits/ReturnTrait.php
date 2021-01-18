<?php

namespace App\Traits;

trait ReturnTrait {

  public function returnView($view,$data) {
    if(!request()->ajax()){
      return view($view,compact($data));
    }
  }

  public function returnRedirect($route,$with=null) {
    if(!request()->ajax()){
      return redirect()->route($route)->with($with);
    }
  }

  public function returnResponse($route,$response=null) {
    if(!request()->ajax()){
      return response()->json(['status' => false,'msg'=> $validator->errors()->getMessageBag()]);
    }
  }
}

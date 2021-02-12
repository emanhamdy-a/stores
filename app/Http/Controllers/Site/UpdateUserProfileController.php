<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUserRequest;
use App\Models\User;

class UpdateUserProfileController extends Controller
{

  public function update(ProfileUserRequest $request)
  {
    try {

      $user = User::find(auth()->user()->id);

      $user->update([
        "name"   => $request->name,
        "mobile" => $request->mobile,
        "password"=>bcrypt($request->password),
      ]);

      return redirect()->back()
      ->with(['success' => __('front/profile.updated')]);

    } catch (\Exception $ex) {
      return redirect()->back()
      ->with(['error' => __('front/profile.error try later')]);

    }

  }


}

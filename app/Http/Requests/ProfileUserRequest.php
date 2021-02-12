<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|min:2',
      'mobile' => 'required|numeric|unique:users,mobile,'.$this -> id,
      'password'  => 'nullable|confirmed|min:8'
    ];
  }

  public function messages(){
    return[
      'nam.required'          => __('front/profile.name required'),
      'nam.min'               => __('front/profile.name length'),
      'mobile.numirec'           => __('front/profile.mobile numirec'),
      'mobile.required'        => __('front/profile.mobile required'),
      'mobile.unique'          => __('front/profile.mobile unique'),
      'password.required'     => __('front/profile.password required'),
      'password.confirmed'    => __('front/profile.password confirmed'),
    ];
  }
}

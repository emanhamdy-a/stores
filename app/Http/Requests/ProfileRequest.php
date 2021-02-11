<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
      'name' => 'required',
      'email' => 'required|email|unique:admins,email,'.$this -> id,
      'password'  => 'nullable|confirmed|min:8'
    ];
  }

  public function messages(){
    return[
      'nam.required'          => __('admin/profile.name required'),
      'nam.min'               => __('admin/profile.name length'),
      'email.email'           => __('admin/profile.valid email'),
      'email.required'        => __('admin/profile.email required'),
      'email.unique'          => __('admin/profile.email unique'),
      'password.required'     => __('admin/profile.password required'),
      'password.confirmed'    => __('admin/profile.password confirmed'),
    ];
  }
}

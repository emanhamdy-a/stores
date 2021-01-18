<?php

namespace App\Http\Requests;

use App\Rules\AdminRequestRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
      "name" => 'required|min:2',
      "role_id" => 'required|numeric|exists:roles,id',
      'email' => 'required|email|unique:admins,email,'.$this -> id,
      'password' => ['required_without:id','confirmed',new AdminRequestRule()],
    ];
  }

  public function messages(){
    return[
      'nam.required'          => __('admin/users.name required'),
      'nam.min'               => __('admin/users.name length'),
      'role_id.required'      => __('admin/users.role required'),
      'role_id.numeric'       => __('admin/users.role numeric'),
      'role_id.exists:roles'  => __('admin/users.role exists'),
      'email.email'           => __('admin/users.valid email'),
      'email.required'        => __('admin/users.email required'),
      'email.unique'          => __('admin/users.email unique'),
      'password.required'     => __('admin/users.password required'),
      'password.confirmed'    => __('admin/users.password confirmed'),
    ];
  }
}

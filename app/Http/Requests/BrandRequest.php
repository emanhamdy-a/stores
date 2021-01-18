<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
      'image'=> 'required_without:id|image|mimes:'. config("image.extends").'|max:'.config("image.size"),
    ];
  }

  public function messages()
  {

    return [
      'name.required' => __('admin/brands.name required'),
      'image.image'   => __('admin/image.choose image'),
      'image.mimes'   => __('admin/image.invalid file'),
      'image.required_without'   => __('admin/image.image required'),
      'image.size'   => __('admin/image.max size'),
    ];
  }

}

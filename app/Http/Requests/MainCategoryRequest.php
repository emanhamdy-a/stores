<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
      'type' => 'required|in:1,2',
      'slug' => 'required|unique:categories,slug,' . $this->id,
      'image'=> 'required_without:id|image|mimes:'. config("image.extends").'|max:'.config("image.size"),
    ];
  }

  public function messages()
  {

    return [
      'name.required' => __('admin/categories.name required'),
      'type.required' => __('admin/categories.type required'),
      'type.in:1,2'   => __('admin/categories.category type'),
      'slug.required' => __('admin/categories.slug required'),
      'slug.unique'   => __('admin/categories.slug unique'),
      'image.image'   => __('admin/image.choose image'),
      'image.mimes'   => __('admin/image.invalid file'),
      'image.required_without'   => __('admin/image.image required'),
      'image.size'   => __('admin/image.max size'),
    ];
  }

}

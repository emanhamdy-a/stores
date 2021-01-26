<?php

namespace App\Http\Requests;

use App\Rules\UniqueProductSlug;
use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
      'name' => 'required|max:100',
      'slug' => ['required',
        new UniqueProductSlug($this->id)],
      'description' => 'required|max:1000',
      'short_description' => 'nullable|max:500',
      'categories' => 'array|min:1',
      'categories.*' => 'numeric|exists:categories,id',
      'tags' => 'nullable',
      'brand_id' => 'required|exists:brands,id',
      'image'=> 'required_without:id|image|mimes:'. config("image.extends").'|max:'.config("image.size"),
    ];
  }

  public function messages()
  {
    return [
      'name.required'              => __('admin/products.name required'),
      'name.max'                   => __('admin/products.name max'),
      'slug.required'              => __('admin/products.slug required'),
      'slug.unique'                => __('admin/products.slug unique'),
      'description.required'       => __('admin/products.description required'),
      'description.max:1000'       => __('admin/products.description max'),
      'short_description.max:500'  => __('admin/products.short description max'),
      'categories'                 => __('admin/products.categories'),
      'tags'                       => __('admin/products.tags'),
      'brand_id.required'          => __('admin/products.brand required'),
      'image.required_without'     =>  __('admin/products.image required'),
      'image.image'                =>  __('admin/products.image image'),
      'image.mimes'                =>  __('admin/products.image mimes'),
      'image.max'                  =>  __('admin/products.image max size'),
    ];
  }

}

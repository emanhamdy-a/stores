<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionsRequest extends FormRequest
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
       'price' => 'required|numeric|min:0',
       'product_id' => 'required|exists:products,id',
       'attribute_id' => 'required|exists:attributes,id',
    ];
  }

  public function messages()
  {
    return [
      'name.required'        => __('admin/options.name required'),
      'price.required'       => __('admin/options.price required'),
      'price.numeric'        => __('admin/options.price number'),
      'product_id.required'  => __('admin/options.product required'),
      'product_id.exists'    => __('admin/options.product required'),
      'attribute_id.required'=> __('admin/options.attribute exist'),
      'attribute_id.exists'  => __('admin/options.attribute exist'),
    ];
  }

}

<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use App\Rules\ProductQty;
use Illuminate\Foundation\Http\FormRequest;

class ProductStockRequest extends FormRequest
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
      'sku' => 'nullable|min:3|max:10',
      'product_id' => 'required|exists:products,id',
      'manage_stock' => 'required|in:0,1',
      'in_stock' => 'required|in:0,1',
      //'qty' => 'required_if:manage_stock,==,1',
      'qty'  =>[new ProductQty($this ->manage_stock )]
    ];
  }

  public function mesages()
  {
    return [
      'sku.nullable'          => __('admin/products.Product code required'),
      'sku.min'               => __('admin/products.Product code min'),
      'sku.max'               => __('admin/products.Product code max'),
      'manage_stock.required' => __('admin/products.manage_stock required'),
      'in_stock.required'     => __('admin/products.in_stock required'),
      'qty'                   => __('admin/products.qty'),
    ];
  }

}

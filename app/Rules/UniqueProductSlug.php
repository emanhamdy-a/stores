<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class UniqueProductSlug implements Rule
{
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  private $productId;

  public function __construct($productId)
  {
    $this->productId = $productId;
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    if($this -> productId)
      //edit form
      $slug = Product::where('id','!=',$this->productId)
      ->where('slug',$value)->first();
    else
      //creation form
      $slug = Product::where('slug',$value)->first();

    if ($slug)
      return false;
    else
      return true;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return __('admin/products.unique slug');
  }
}

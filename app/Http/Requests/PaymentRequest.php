<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
      'ccNam' => 'required',
      'ccNum' => 'required',
      'ccExp' => 'required',
      'ccCvv' => 'required|numeric',
      'amount' => 'required|numeric|min:100',
    ];
  }

  public function messages()
  {
    return [
      'ccNam.required'  => __('front/payment.name required'),
      'ccNum.required'  => __('front/payment.card number required'),
      'ccExp.required'  => __('front/payment.expiration required'),
      'ccCvv.required'  => __('front/payment.security code required'),
      'ccCvv.numirec'   => __('front/payment.security code numirec'),
    ];
  }
}

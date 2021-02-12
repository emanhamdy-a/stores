<?php


namespace App\Http\Interfaces;

interface PaymentRepositoryInterface
{

  /**
   * send payment requeset and get responce
   */
  public function processPayment($request,$token,$base_url);

  /**
   * save order to order table
   */
  public function saveOrder($amount, $PaymentMethodId);

}

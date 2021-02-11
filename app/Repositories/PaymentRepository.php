<?php


namespace App\Repositories;
use App\Models\Order;
use App\Models\Transaction;
use App\Http\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{

  /**
   * send payment requeset and get responce
   */
  public function processPayment($request,$token,$base_url)
  {
    $ccNum = str_replace(' ', '', $request->ccNum);
    $ccExp = $request->ccExp;
    $ccCvv = $request->ccCvv;
    $amount = $request->amount;
    $customerName = auth()->user()->name;
    $customerEmail = 'demo@gmail.com';
    $phone = substr(auth()->user()->mobile, 4);
    $ccExp = (explode('/', $ccExp));
    $ccMon = $ccExp[0];
    $ccYear = $ccExp[1];
    $customerMobile = strlen($phone) <= 11 ? $phone : '123456';
    $data['Language'] = 'en';
    $PaymentMethodId = $request->PaymentMethodId;
    $token = $token;
    $basURL = $base_url;
    $curl = curl_init();


    curl_setopt_array($curl, array(
      CURLOPT_URL => "$basURL/v2/ExecutePayment",
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"PaymentMethodId\":\"$PaymentMethodId\",\"CustomerName\": \"$customerName\",\"DisplayCurrencyIso\": \"SAR\", \"MobileCountryCode\":\"+965\",\"CustomerMobile\": \"$customerMobile\",\"CustomerEmail\": \"$customerEmail\",\"InvoiceValue\": $amount,\"CallBackUrl\": \"https://dieera.com\",\"ErrorUrl\": \"https://dieera.com\",\"Language\": \"en\",\"CustomerReference\" :\"ref 1\",\"CustomerCivilId\":12345678,\"UserDefinedField\": \"Custom field\",\"ExpireDate\": \"\",\"CustomerAddress\" :{\"Block\":\"\",\"Street\":\"\",\"HouseBuildingNo\":\"\",\"Address\":\"\",\"AddressInstructions\":\"\"},\"InvoiceItems\": []}",
      CURLOPT_HTTPHEADER => array("Authorization: Bearer $token", "Content-Type: application/json"),
    ));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      return[
        "IsSuccess" => false,
        'error' => $err,
      ];
    }

    $json = json_decode((string)$response, true);

    //echo "json  json: $json '<br />'";

    if(!$payment_url = $json["Data"]["PaymentURL"]){
      return[
        "IsSuccess" => false,
        'error' => $err,
      ];
    };

    $card = new \stdClass();
    $card->Number = $ccNum;
    $card->expiryMonth = trim($ccMon);
    $card->expiryYear = trim($ccYear);
    $card->securityCode = trim($ccCvv);
    $card_data = json_encode($card);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "$payment_url",
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"paymentType\": \"card\",\"card\":$card_data,\"saveToken\": false}",
      CURLOPT_HTTPHEADER => array("Authorization: Bearer $token", "Content-Type: application/json"),
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return[
        "IsSuccess" => false,
        'error' => $err,
      ];
    }

    return json_decode((string)$response, true);
  }

  /**
   * save order to order table
   */
  public function saveOrder($amount, $PaymentMethodId)
  {
    return Order::create([
      'customer_id' => auth()->id(),
      'customer_phone' => auth()->user()->mobile,
      'customer_name' => auth()->user()->name,
      'total' => $amount,
      'locale' => 'en',
      'payment_method' => $PaymentMethodId,
      'status' => Order::PAID,
    ]);
  }

  /**
   * save transaction to transaction table
   */
  public function saveTransaction(Order $order, $PaymentId)
  {
    Transaction::create([
      'order_id' => $order->id,
      'transaction_id' => $PaymentId,
      'payment_method' => $order->payment_method,
    ]);
  }

}

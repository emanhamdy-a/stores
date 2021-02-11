<?php

namespace App\Http\Controllers\Site;

use App\Models\Order;
use GuzzleHttp\Client;

use App\Events\NewOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
  private $base_url;
  private $request_client;
  private $token;

  public function __construct(Client $request_client)
  {
    $this->request_client = $request_client;
    $this->base_url = MYFATOORAHBASEURL;//env('MYFATOORAHBASEURL');
    $this->token = MYFATOORAHTOKEN;//env('MYFATOORAHTOKEN');
  }

  public function getPayments($amount)
  {
    return view('front.cart.payments', compact('amount'));
  }

  /**
   * @param Request $request
   */
  public function processPayment(PaymentRequest $request)
  {
    $error = '';

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
    $token = $this->token;
    $basURL = $this->base_url;
    $curl = curl_init();


    // you can use laravel http or Guzzl and you my create an object to encode that oject direct on requrest
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
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
        ]);
        // 'error' => $err
    }

    $json = json_decode((string)$response, true);

    //echo "json  json: $json '<br />'";

    if(!$payment_url = $json["Data"]["PaymentURL"]){
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
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
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
        // 'error' => $err
    }

    $json = json_decode((string)$response, true);

    if(!$payment_url = $json["Data"]["PaymentURL"]){
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
    };

    try {
      DB::beginTransaction();
      // if success payment save order and send realtime notification to admin
      $order = $this->saveOrder($amount, $PaymentMethodId);  // your task is  . add products with options to order to preview on admin
      $this->saveTransaction($order, $PaymentId);

      DB::commit();

      //fire event on order complete success for realtime notification
      event(new NewOrder($order));

      return redirect()->route('payment',$request->amount)->with([
        'success' => __('front/payment.success'),
        'payment_success' => true,
        'status' => 'succeeded',
        'token' => $PaymentId,
        'data' => $json,
        ]);

    } catch (\Exception $ex) {
      DB::rollBack();
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
      // return $ex;
    }
  }

  private function saveOrder($amount, $PaymentMethodId)
  {
    return Order::create([
      'customer_id' => auth()->id(),
      'customer_phone' => auth()->user()->mobile,
      'customer_name' => auth()->user()->name,
      'total' => $amount,
      'locale' => 'en',
      'payment_method' => $PaymentMethodId,
        // you can use enumeration here
      'status' => Order::PAID,
    ]);
  }

  private function saveTransaction(Order $order, $PaymentId)
  {
    Transaction::create([
      'order_id' => $order->id,
      'transaction_id' => $PaymentId,
      'payment_method' => $order->payment_method,
    ]);
  }
}

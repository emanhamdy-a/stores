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
use App\Repositories\PaymentRepository;

class PaymentController extends Controller
{
  private $base_url;
  private $request_client;
  private $token;
  protected $repository;

  public function __construct(PaymentRepository $repository,Client $request_client)
  {
    $this->request_client = $request_client;
    $this->base_url = MYFATOORAHBASEURL;//env('MYFATOORAHBASEURL');
    $this->token = MYFATOORAHTOKEN;//env('MYFATOORAHTOKEN');
    $this->repository = $repository;
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

    $token = $this->token;
    $base_url = $this->base_url;

     $json=$this->repository->processPayment($request,$token,$base_url);

    if(!$json['IsSuccess']){
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
    }

    $PaymentMethodId = $request->PaymentMethodId;
    $amount = $request->amount;

    if(!$PaymentId = $json["Data"]["PaymentId"]){
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
    };

    try {
      DB::beginTransaction();

      $order = $this->repository->saveOrder($amount, $PaymentMethodId);

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
      // return $ex;
      return redirect()->route('payment',$request->amount)->with([
        'error' => __('front/payment.error try later'),
        'payment_success' => false,
        'status' => 'faild',
      ]);
    }
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

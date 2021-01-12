<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use DB;
class SettingsController extends Controller
{

  public function editShippingMethods($type)
  {

    if ($type === 'free')
      $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

    elseif ($type === 'inner')
      $shippingMethod = Setting::where('key', 'local_label')
      ->first();

    elseif ($type === 'outer')
      $shippingMethod = Setting::where('key', 'outer_label')
      ->first();
    else
      $shippingMethod = Setting::where('key',
      'free_shipping_label')->first();

      return view('dashboard.settings.shippings.edit',
      compact('shippingMethod'));

  }

  public function updateShippingMethods(ShippingsRequest $request, $id)
  {

      $shipping_method = Setting::find($id);

      DB::beginTransaction();
      $shipping_method->update(['plain_value' => $request->plain_value]);
      //save translations
      app()->setLocale('fr');
      $shipping_method->value = $request->value;
      // $shipping_method->translation($request->lang)->value = $request->value;
      $shipping_method->save();
      DB::commit();
      return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
      try {
    } catch (\Exception $ex) {
      return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
      DB::rollback();
    }
  }

}

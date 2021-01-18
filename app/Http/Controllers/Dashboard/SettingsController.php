<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

      $shipping_method = Setting::findOrFail($id);

      DB::beginTransaction();

      $shipping_method->update(['plain_value' => $request->plain_value]);

      app()->setLocale($request->lang);

      $shipping_method->value = $request->value;

      $shipping_method->save();

      DB::commit();
      return redirect()->back()->with(['success' => __('admin/settings.updated')]);
      try {
    } catch (\Exception $ex) {
      return redirect()->back()->with(['error' => __('admin/settings.error')]);
      DB::rollback();
    }
  }

}

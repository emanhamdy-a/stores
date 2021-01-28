@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
      <h4 class="card-title">{{ __('admin\products.manage store') }}</h4>
      </div>
    </div>
    <div class="content-body">
      <!-- Basic form layout section start -->
      <section id="basic-form-layouts">
        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">
                {{ __('admin\products.manage store') }}
                </h4>
                <a class="heading-elements-toggle"><i
                    class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  </ul>
                </div>
              </div>
              @include('dashboard.includes.alerts.success')
              @include('dashboard.includes.alerts.errors')
              <div class="card-content collapse show">
                <div class="card-body">
                  <form class="form"
                      action="{{route('admin.products.stock.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="product_id" value="{{$id}}">
                    <div class="form-body">

                      <h4 class="form-section"><i class="ft-home"></i>
                      {{ __('admin\products.manage store') }}
                      </h4>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.product code') }}
                            </label>
                            <input type="text" id="sku"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('sku') }}"
                                  name="sku">
                            @error("sku")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.trace store') }}
                            </label>
                            <select name="manage_stock" class="select2 form-control" id="manageStock">
                              <optgroup label="{{ __('admin\products.please choose type') }}">
                                <option value="1">
                                {{ __('admin\products.allow track') }}
                                </option>
                                <option value="0" selected>
                                {{ __('admin\products.dont allow track') }}
                                </option>
                              </optgroup>
                            </select>
                            @error('manage_stock')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <!-- QTY  -->



                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.product status') }}
                            </label>
                            <select name="in_stock" class="select2 form-control" >
                              <optgroup label="{{ __('admin\products.please choose') }}">
                                <option value="1">
                                  {{ __('admin\products.available') }}
                                </option>
                                <option value="0">
                                {{ __('admin\products.not available') }}
                                </option>
                              </optgroup>
                            </select>
                            @error('in_stock')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>


                        <div class="col-md-6" style="display:none"  id="qtyDiv">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.quantity') }}
                            </label>
                            <input type="text" id="sku"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('qty') }}"
                                  name="qty">
                            @error("qty")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1"
                          onclick="history.back();">
                        <i class="ft-x"></i>
                        {{ __('admin\products.cancel') }}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{ __('admin\products.save') }}
                      </button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- // Basic form layout section end -->
    </div>
  </div>
</div>

@stop

@section('script')
<script>
  $(document).on('change','#manageStock',function(){
    if($(this).val() == 1 ){
      $('#qtyDiv').show();
    }else{
      $('#qtyDiv').hide();
    }
  });
</script>
@stop

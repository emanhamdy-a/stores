@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
      <h4 class="card-title">{{ __('admin\products.product price') }} </h4>
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
                {{ __('admin\products.product price') }}
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
                      action="{{route('admin.products.price.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="product_id" value="{{$id}}">
                    <div class="form-body">

                      <h4 class="form-section"><i class="ft-home"></i>
                      {{ __('admin\products.product price data') }}
                      </h4>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.product price') }}
                            </label>
                            <input type="number" id="price"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('price') }}"
                                  name="price">
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.specieal price') }}
                            </label>
                            <input type="number"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('special_price') }}"
                                  name="special_price">
                            @error("special_price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.price type') }}
                            </label>
                            <select name="special_price_type" class="select2 form-control" >
                              <optgroup label="{{ __('admin\products.product price') }} ">
                                <option value="percent">precent</option>
                                <option value="fixed">fixed</option>
                              </optgroup>
                            </select>
                            @error('special_price_type')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>


                      </div>


                      <div class="row" >
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.start date') }}
                            </label>

                            <input type="date" id="price"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('special_price_start') }}"
                                  name="special_price_start">

                            @error('special_price_start')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\products.end date') }}
                            </label>
                            <input type="date" id="price"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('special_price_end') }}"
                                  name="special_price_end">

                            @error('special_price_end')
                            <span class="text-danger"> {{$message}}</span>
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


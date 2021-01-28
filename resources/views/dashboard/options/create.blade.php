
@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">{{ __('admin\options.create option') }}</h3>
        </div>
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
                <h3 class="content-header-title">{{ __('admin\options.create option') }}</h3>
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
                      action="{{route('admin.options.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf



                    <div class="form-body">

                      <h4 class="form-section"><i class="ft-home"></i>
                      <h3 class="content-header-title">{{ __('admin\options.option data') }}</h3>
                      </h4>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            <h3 class="content-header-title">{{ __('admin\options.name') }}</h3>

                                </label>
                            <input type="text" id="name"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('name') }}"
                                  name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            <h3 class="content-header-title">{{ __('admin\options.price') }}</h3>

                            </label>
                            <input type="text" id="price"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('price') }}"
                                  name="price">
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            <h3 class="content-header-title">{{ __('admin\options.choose product') }}</h3>

                            </label>
                            <select name="product_id" class="select2 form-control" >
                              <optgroup
                              label="{{ __('admin\options.please choose product') }} ">
                                @if($products && $products -> count() > 0)
                                  @foreach($products as $product)
                                    <option
                                      value="{{$product -> id }}">{{$product -> name}}</option>
                                  @endforeach
                                @endif
                              </optgroup>
                            </select>
                            @error('product_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin\options.choose attribute') }}
                            </label>
                            <select name="attribute_id" class="select2 form-control" >
                              <optgroup
                              label="{{ __('admin\options.please choose attribute') }}">
                                @if($attributes && $attributes -> count() > 0)
                                  @foreach($attributes as $attribute)
                                    <option
                                      value="{{$attribute -> id }}">{{$attribute -> name}}</option>
                                  @endforeach
                                @endif
                              </optgroup>
                            </select>
                            @error('attribute_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>

                      </div>
                      @include('dashboard.includes.language_select')
                    </div>


                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1"
                          onclick="history.back();">
                        <i class="ft-x"></i>
                        {{ __('admin\options.cancel') }}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{ __('admin\options.save') }}
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

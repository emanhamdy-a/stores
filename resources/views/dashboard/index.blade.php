@extends('layouts.admin')
@section('content')
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div id="crypto-stats-3" class="row">
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card crypto-card-3 pull-up">
            <div class="card-content">
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-2">
                    <h1><i class="cc BTC warning font-large-2" title="BTC"></i></h1>
                  </div>
                  <div class="col-5 pl-2">
                    <!-- <h4>BTC</h4> -->
                    <h6 class="text-muted">{{__('admin/home.new products')}}</h6>
                  </div>
                  <div class="col-5 text-right">
                    <h4>{{ $productn }}</h4>
                    <!-- <h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6> -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card crypto-card-3 pull-up">
            <div class="card-content">
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-2">
                    <h1><i class="cc ETH blue-grey lighten-1 font-large-2" title="ETH"></i></h1>
                  </div>
                  <div class="col-5 pl-2">
                    <!-- <h4>ETH</h4> -->
                    <h6 class="text-muted">{{__('admin/home.new categories')}}</h6>
                  </div>
                  <div class="col-5 text-right">
                    <h4>{{ $categoryn }}</h4>
                    <!-- <h6 class="success darken-4">12% <i class="la la-arrow-up"></i></h6> -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="eth-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card crypto-card-3 pull-up">
            <div class="card-content">
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-2">
                    <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                  </div>
                  <div class="col-5 pl-2">
                    <!-- <h4>XRP</h4> -->
                    <h6 class="text-muted">{{__('admin/home.new brands')}}</h6>
                  </div>
                  <div class="col-5 text-right">
                    <h4>{{ $brandn }}</h4>
                    <!-- <h6 class="danger">20% <i class="la la-arrow-down"></i></h6> -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="xrp-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card crypto-card-3 pull-up">
            <div class="card-content">
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-2">
                    <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                  </div>
                  <div class="col-5 pl-2">
                    <!-- <h4>XRP</h4> -->
                    <h6 class="text-muted">{{__('admin/home.new admins')}}</h6>
                  </div>
                  <div class="col-5 text-right">
                    <h4>{{ $brandn }}</h4>
                    <!-- <h6 class="danger">20% <i class="la la-arrow-down"></i></h6> -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="xrp-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Candlestick Multi Level Control Chart -->

      <!-- new product -->
      <div class="row match-height">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">{{ __('admin/home.latest products') }} </h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>

            <div class="card-content collapse show">
              <div class="card-body card-dashboard">
                <table id='Mydatatable'
                  class="table display nowrap table-striped table-bordered  scroll-horizontal w-100">
                  <thead class="">
                    <tr>
                      <th>{{ __('admin/home.name') }}</th>
                      <th> {{ __('admin/home.slug') }}</th>
                      <th>{{ __('admin/home.status') }}</th>
                      <th>{{ __('admin/home.price') }}</th>
                      <th></th>
                      <th>{{ __('admin/home.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>

                    @isset($products)
                    @foreach($products as $product)
                    <tr>
                      <td>{{$product -> name}}</td>
                      <td>{{$product -> slug}}</td>
                      <td>{{$product -> getActive()}}</td>
                      <td>{{$product -> price}}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{route('admin.products.price',$product -> id)}}"
                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                            {{ __('admin/home.price') }}
                          </a>

                          <a href="{{route('admin.products.images',$product)}}"
                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                            {{ __('admin/home.images') }}
                          </a>

                          <a href="{{route('admin.products.stock',$product -> id)}}"
                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                            {{ __('admin/home.store') }}
                          </a>

                        </div>
                      </td>
                      <td class=''>
                        <ul class="nav navbar-nav float-right">
                          <!-- actions -->
                          <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            </a>
                            <div class="dropdown-menu dropdown-menu-left">
                              <a class="dropdown-item btn btn-outline-primary"
                                href="{{route('admin.products.edit',$product->id)}}">
                                {{ __('admin/home.edit') }}
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item danger dropdown-item btn btn-outline-primary"
                                href="{{route('admin.products.delete',$product->id)}}">
                                {{ __('admin/home.delete') }}
                              </a>
                              <div class="dropdown-divider"></div>
                              <!-- <a class="dropdown-item primary dropdown-item btn btn-outline-primary"
                                    href="{{route('admin.products.general.update',$product->id)}}">
                                    {{ __('admin/home.view') }}
                                  </a> -->
                            </div>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    @endforeach
                    @endisset
                  </tbody>
                </table>
                <div class="justify-content-center d-flex">

                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Sell Orders & Buy Order -->
      </div>
    </div>
  </div>
  @endsection

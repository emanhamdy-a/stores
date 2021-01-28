
@extends('layouts.admin')
@section('content')

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
        <!-- DOM - jQuery events table -->
        <section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">{{ __('admin\products.products') }} </h4>
                  <a class="heading-elements-toggle"><i
                    class="la la-ellipsis-v font-medium-3"></i>
                  </a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>

                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')

                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                  <table id='Mydatatable'
                  class="table display nowrap table-striped table-bordered  scroll-horizontal w-100">
                    <thead class="">
                      <tr>
                        <th>{{ __('admin/products.name') }}</th>
                        <th> {{ __('admin/products.slug') }}</th>
                        <th>{{ __('admin/products.status') }}</th>
                        <th>{{ __('admin/products.price') }}</th>
                        <th></th>
                        <th>{{ __('admin/products.actions') }}</th>
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
                            <div class="btn-group" role="group"
                                aria-label="Basic example">
                              <a
                              href="{{route('admin.products.price',$product -> id)}}"
                                  class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                  {{ __('admin/products.price') }}
                              </a>

                              <a href="{{route('admin.products.images',$product)}}"
                                  class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                  {{ __('admin/products.images') }}
                              </a>

                              <a href="{{route('admin.products.stock',$product -> id)}}"
                                  class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                  {{ __('admin/products.store') }}
                              </a>

                            </div>
                          </td>
                          <td class=''>
                            <ul class="nav navbar-nav float-right">
                              <!-- actions -->
                              <li class="dropdown dropdown-user nav-item">
                                <a
                                  class="dropdown-toggle nav-link dropdown-user-link"
                                  href="#" data-toggle="dropdown">
                                </a>
                                <div
                                  class="dropdown-menu dropdown-menu-left">
                                  <a class="dropdown-item btn btn-outline-primary"
                                    href="{{route('admin.products.edit',$product->id)}}">
                                    {{ __('admin/products.edit') }}
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item danger dropdown-item btn btn-outline-primary"
                                    href="{{route('admin.products.delete',$product->id)}}">
                                    {{ __('admin/products.delete') }}
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  <!-- <a class="dropdown-item primary dropdown-item btn btn-outline-primary"
                                    href="{{route('admin.products.general.update',$product->id)}}">
                                    {{ __('admin/products.view') }}
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
        </div>
        {!! $products -> links() !!}
      </section>
    </div>
  </div>
</div>

  @stop
  @section('script')

  @endsection

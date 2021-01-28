@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">{{ __('admin\options.options') }}</h3>
      </div>
    </div>
    <div class="content-body">
      <!-- DOM - jQuery events table -->
      <section id="dom">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">{{ __('admin\options.all options') }}</h4>
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
                <div class="card-body card-dashboard">
                  <table
                    class="table display nowrap table-striped table-bordered  scroll-horizontal w-100">
                    <thead class="">
                    <tr>
                      <th>{{ __('admin\options.name') }}</th>
                      <th>{{ __('admin\options.price') }}</th>
                      <th>{{ __('admin\options.product') }}</th>
                      <th>{{ __('admin\options.attribute') }}</th>
                      <th>{{ __('admin\options.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($options)
                      @foreach($options as $option)
                        <tr>
                          <td>{{$option -> name}}</td>
                          <td>{{$option ->price}}</td>
                          <td>{{$option ->product->name ?? ''}}</td>
                          <td>{{$option ->attribute->name ?? ''}}</td>
                          <td>
                            <div class="btn-group" role="group"
                                aria-label="Basic example">
                              <a href="{{route('admin.options.edit',$option -> id)}}"
                                  class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                              <a href="{{route('admin.options.delete',$option -> id)}}"
                                  class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                            </div>
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
      </section>
    </div>
  </div>
</div>

@stop

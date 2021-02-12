@extends('layouts.site')

@section('content')
<nav data-depth="1" class="breadcrumb-bg">
  <div class="container no-index">
    <div class="breadcrumb">

    </div>
  </div>
</nav>

<div class="container no-index pb-5">
  <div class="row">
    <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <section id="main">

        <h1 class="page-title">
          {{ __('front/orders.orders') }}
        </h1>

        <div class="card-content collapse show">
          <div class="card-body card-dashboard">
            <table
              class="table display nowrap table-striped table-bordered  scroll-horizontal w-100">
              <thead class="">
              <tr>
                <th>{{ __('front/orders.status') }}</th>
                <th>{{ __('front/orders.total') }} </th>
                <th>{{ __('front/orders.date') }} </th>
              </tr>
              </thead>
              <tbody>

              @isset($orders)
                @foreach($orders as $order)
                  <tr>
                    <td>{{$order -> status}}</td>
                    <td>{{$order -> total}}</td>
                    <td>{{$order -> created_at}}</td>
                  </tr>
                @endforeach
              @endisset
              </tbody>
            </table>
          </div>
        </div>

      </section>
    </div>
  </div>
</div>
@stop


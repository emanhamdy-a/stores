
@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">
        {{ __('admin/users.all users') }}
        </h3>
      </div>
    </div>
    <div class="content-body">
      <!-- DOM - jQuery events table -->
      <section id="dom">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">{{ __('admin/users.all users') }}</h4>
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
                    class="table display nowrap table-striped table-bordered">
                    <thead class="">
                    <tr>
                      <th>{{ __('admin/users.name') }}</th>
                      <th>{{ __('admin/users.email') }} </th>
                      <th>{{ __('admin/users.role') }} </th>
                      <th>{{ __('admin/users.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($users )
                      @foreach($users as $user)
                        <tr>
                          <td>{{$user -> name}}</td>
                          <td>{{$user -> email}}</td>
                          <td>
                            {{$user -> role -> name}}
                          </td>
                          <td>
                            <div class="btn-group" role="group"
                                aria-label="Basic example">
                              <a
                              href="{{route('admin.users.edit',$user -> id)}}"
                                  class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                  {{ __('admin/users.edit') }}
                              </a>
                            </div>
                            <div class="btn-group" role="group"
                                aria-label="Basic example">
                              <a
                              href="{{route('admin.users.delete',$user-> id)}}"
                                  class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                  {{ __('admin/users.delete') }}
                              </a>
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

@extends('layouts.admin')
@section('content')
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">{{ __('admin/users.update user') }} </h3>
      </div>
    </div>
    <div class="content-body">
      <!-- Basic form layout section start -->
      <section id="basic-form-layouts">
        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"> {{ __('admin/users.update user') }}
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
                      action="{{route('admin.users.update',$user->id)}}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id"
                    value="{{$user->id}}">
                    <div class="form-body">
                      <h4 class="form-section"><i class="ft-home"></i>
                      {{ __('admin/users.user data') }}
                      </h4>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/users.name') }}
                            </label>
                            <input type="text" id="name"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('name') ?? $user->name}}"
                                  name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/users.email') }}
                            </label>
                            <input type="email" id="email"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('email') ?? $user->email}}"
                                  name="email">
                            @error("email")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/users.choose role') }}
                            </label>
                            <select name="role_id" class="select2 form-control" >
                              <optgroup label="{{ __('admin/users.please choose role') }}">
                                @if($roles && $roles -> count() > 0)
                                  @foreach($roles as $role)
                                    <option
                                      @if($role->id == $user->role->id ) {{ 'selected' }} @endif
                                      value="{{$role -> id }}">{{$role -> name}}</option>
                                  @endforeach
                                @endif
                              </optgroup>
                            </select>
                            @error('role_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/users.password') }}
                            </label>
                            <input type="password" id="password"
                                  class="form-control"
                                  placeholder="  "
                                  name="password">
                            @error("password")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/users.confirm password') }}
                            </label>
                            <input type="password" id=""
                                  class="form-control"
                                  placeholder="  "
                                  name="password_confirmation" >
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1"
                          onclick="history.back();">
                        <i class="ft-x"></i>
                        {{ __('admin/users.cancel') }}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{ __('admin/users.save') }}
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


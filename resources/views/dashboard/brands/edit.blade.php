
@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">{{__('admin\brands.update brand')}}</h3>
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
                  {{__('admin\brands.update brand')}}
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
                      action="{{route('admin.brands.update',$brand -> id)}}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input name="id" value="{{$brand -> id}}" type="hidden">

                    <div class="form-group">
                      <div class="text-center">
                        <img
                        src="{{url('/').'/images/brands/'.$brand  -> img()->filename }}"
                          class="rounded-circle  height-250"
                          alt="{{__('admin\brands.image')}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label> {{__('admin\brands.image')}} </label>
                      <label id="projectinput7" class="file center-block">
                        <input type="file" name="image">
                        <span class="file-custom"></span>
                      </label>
                      @error('image')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>

                    <div class="form-body">

                      <h4 class="form-section"><i class="ft-home"></i>
                        {{__('admin\brands.brand data')}}
                      </h4>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                              {{__('admin\brands.name')}}
                            </label>
                            <input type="text" id="name"
                                  class="form-control"
                                  placeholder=" "
                                  value="{{$brand -> name}}"
                                  name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mt-1">
                            <input type="checkbox" value="1"
                                  name="is_active"
                                  id="switcheryColor4"
                                  class="switchery" data-color="success"
                                  @if($brand -> is_active == 1)checked @endif />
                            <label for="switcheryColor4"
                                  class="card-title ml-1">
                              {{__('admin\brands.status')}}
                            </label>

                            @error("is_active")
                            <span class="text-danger">{{$message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1"
                          onclick="history.back();">
                        <i class="ft-x"></i>
                        {{__('admin\brands.cancel')}}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{__('admin\brands.save')}}
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

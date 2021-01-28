
@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"> {{ __('admin/tags.create tag') }} </h3>
      </div>
    </div>
    <div class="content-body">
      <!-- Basic form layout section start -->
      <section id="basic-form-layouts">
        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
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
                      action="{{route('admin.tags.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">

                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                              {{ __('admin/tags.name') }}
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
                                {{ __('admin/tags.slug') }}
                              </label>
                              <input type="text" id="name"
                                class="form-control"
                                placeholder="  "
                                value="{{old('slug') }}"
                                name="slug">
                              @error("slug")
                              <span class="text-danger">{{$message}}</span>
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
                        {{ __('admin/tags.cancel') }}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{ __('admin/tags.save') }}
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

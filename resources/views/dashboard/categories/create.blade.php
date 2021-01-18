@extends('layouts.admin')
@section('content')

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">
           {{__('admin\categories.add category')}} </h3>
        </div>
      </div>
      <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="basic-form-layouts">
          <div class="row match-height">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"
                    id="basic-layout-form">
                    {{__('admin\categories.add category')}}</h4>
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
                  <div class="card-body">
                    <form class="form"
                        action="{{route('admin.maincategories.store')}}"
                        method="POST"
                        enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label> {{__('admin\categories.category image')}}</label>
                        <label id="projectinput7" class="file center-block">
                          <input type="file"  name="image">
                          <span class="file-custom"></span>
                        </label>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                      <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>
                        {{__('admin\categories.category data')}}
                        </h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1"> {{__('admin\categories.category name')}} </label>
                              <input type="text" id="name"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{old('name')}}"
                                   name="name">
                              @error("name")
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1"> {{__('admin\categories.slug')}}</label>
                              <input type="text" id="name"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{old('slug')}}"
                                   name="slug">
                              @error("slug")
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row hidden col-12" id="cats_list" >
                          <div class="col-12">
                            <div class="form-group">
                              <lable for="projectinput1">                            {{__('admin\categories.choose main category')}}
                              </label>
                              <select name="parent_id"
                                class="select2 form-control col-12">
                                <option value='' class='dark'>
                                {{__('admin\categories.choose main category')}}
                                </option>
                                  @if($categories && $categories -> count() > 0)
                                    @foreach($categories as $category)
                                      <option
                                        value="{{$category -> id }}">{{$category -> name}}</option>
                                    @endforeach
                                  @endif
                              </select>
                              @error('parent_id')
                              <span class="text-danger"> {{$message}}</span>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-1">
                              <input type="checkbox" value="1"
                                   name="is_active"
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   checked/>
                              <label for="switcheryColor4"
                                   class="card-title ml-1">{{__('admin\categories.status')}} </label>

                              @error("is_active")
                              <span class="text-danger">{{$message }}</span>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group mt-1">
                              <input type="radio"
                                   name="type"
                                   value="1"
                                   checked
                                   class="switchery"
                                   data-color="success"
                              />

                              <label
                                class="card-title ml-1">
                                {{__('admin\categories.main category')}}
                              </label>

                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group mt-1">
                              <input type="radio"
                                   name="type"
                                   value="2"
                                   class="switchery" data-color="success"
                              />

                              <label
                                class="card-title ml-1">
                                {{__('admin\categories.sub category')}}
                              </label>

                            </div>
                          </div>
                        </div>

                        @include('dashboard.includes.language_select')
                      </div>


                      <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1"
                            onclick="history.back();">
                          <i class="ft-x"></i> {{__('admin\categories.cancel')}}
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> {{__('admin\categories.save')}}
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

@section('script')

  <script>
    $('input:radio[name="type"]').change(
      function(){
        if (this.checked && this.value == '2') {
           // 1 if main cat - 2 if sub cat
          $('#cats_list').removeClass('hidden');

        }else{
          $('#cats_list').addClass('hidden');
        }
      });
  </script>
  @stop

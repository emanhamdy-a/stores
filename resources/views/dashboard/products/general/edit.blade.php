@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
        <h3 class="content-header-title">{{ __('admin/products.update product') }} </h3>
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
                {{ __('admin/products.update product') }}
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
                      action="{{route('admin.products.general.update',$product->id)}}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name='id' value='{{ $product->id }}'>
                    <div class="form-body">
                      <h4 class="form-section"><i class="ft-home"></i>
                      {{ __('admin/products.product data') }}
                      </h4>
                      <div class="form-group">
                        <div class="text-center">
                          <img src="{{url('/').'/images/products/'.$product  -> main_image ?? '' }}"
                            class="rounded-circle  height-150" alt="{{ __('admin/categories.category image') }}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> {{__('admin/products.product main image')}}</label>
                            <label id=""
                              class="file center-block">
                              <input type="file"  name="image">
                              <span class="file-custom"></span>
                            </label>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.name') }}
                            </label>
                            <input type="text" id="name"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('name') ?? $product -> name}}"
                                  name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.slug') }}
                            </label>
                            <input type="text"
                                  class="form-control"
                                  placeholder="  "
                                  value="{{old('slug') ?? $product -> slug}}"
                                  name="slug">
                            @error("slug")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.discreption') }}
                            </label>
                            <textarea  name="description" id="description"
                              class="form-control"
                              placeholder="">{{old('description') ?? $product -> description}}</textarea>
                            @error("description")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.small discreption') }}
                            </label>
                            <textarea  name="short_description"
                                    class="form-control"
                                    placeholder=""
                            >{{old('short_description') ?? $product -> short_description}}</textarea>

                            @error("short_description")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row" >

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.choose category') }}
                            </label>
                            <select name="categories[]" class="select2 form-control" multiple>
                              <optgroup
                              label="{{ __('admin/products.please choose category') }}">
                                @if($categories && $categories -> count() > 0)
                                  @foreach($categories as $category)
                                    <option
                                      value="{{$category -> id }}"
                                      <?php
                                      if(in_array($category->id,$product->cat_ids()->toArray())){
                                        echo 'selected';
                                      }
                                      ?>
                                    >
                                      {{$category -> name}}

                                    </option>
                                  @endforeach
                                @endif
                              </optgroup>
                            </select>
                            @error('categories.0')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.choose tag') }}
                            </label>
                            <select name="tags[]" class="select2 form-control" multiple>
                              <optgroup
                              label="{{ __('admin/products.choose tag') }}">
                                @if($tags && $tags -> count() > 0)
                                  @foreach($tags as $tag)
                                    <option
                                      value="{{$tag -> id }}"
                                      <?php
                                      if(in_array($tag->id,$product->tag_ids()->toArray())){
                                        echo 'selected';
                                      }
                                      ?>
                                      >{{$tag -> name}}
                                      </option>
                                  @endforeach
                                @endif
                              </optgroup>
                            </select>
                            @error('tags')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="projectinput1">
                            {{ __('admin/products.choose brand') }}
                            </label>
                            <select name="brand_id" class="select2 form-control">
                              <optgroup
                              label="{{ __('admin/products.please choose brand') }}">
                                @if($brands && $brands -> count() > 0)
                                  @foreach($brands as $brand)
                                    <option
                                      value="{{$brand -> id }}"
                                      <?php
                                        if($brand -> id == $product->brand -> id){
                                          echo 'selected';
                                        }
                                      ?>
                                      >{{$brand -> name}}
                                    </option>
                                  @endforeach
                                @endif
                              </optgroup>
                            </select>
                            @error('brand_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                          </div>
                        </div>

                      </div>
                      <div class="row">

                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group mt-1">
                            <input type="checkbox" value="1"
                                  name="is_active"
                                  id="switcheryColor4"
                                  class="switchery" data-color="success"
                                  checked/>
                            <label for="switcheryColor4"
                                  class="card-title ml-1">
                            {{ __('admin/products.status') }}
                             </label>

                            @error("is_active")
                            <span class="text-danger">{{$message }}</span>
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
                        {{ __('admin/products.cancel') }}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> {{ __('admin/products.save') }}
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

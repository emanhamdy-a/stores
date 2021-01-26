@extends('layouts.admin')
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">

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
                 {{ __('admin/products.manage images') }}
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
              <div class="row mr-2 ml-2">
                <button type="text"
                  class="btn btn-lg btn-block btn-outline-success mb-2 msg hidden"
                  id="type-error">
                </button>
              </div>
              @include('dashboard.includes.alerts.errors')
              <div class="card-content collapse show">
                <div class="card-body">
                  <form class="form"
                    action=""
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id"
                      value="{{$product->id}}">
                    <div class="form-body">
                      <h4 class="form-section"><i class="ft-home"></i>
                      {{ __('admin/products.product images') }}
                      </h4>
                      <div class="form-group">
                        <div id="dpz-multiple-files"
                          class="dropzone dropzone-area">
                          <div class="dz-message">
                          {{ __('admin/products.upload images') }}
                          </div>
                        </div>
                        <br><br>
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1"
                          onclick="history.back();">
                        <i class="ft-x"></i>
                        {{ __('admin/products.cancel') }}
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
  var uploadedDocumentMap = {}
  Dropzone.options.dpzMultipleFiles = {
  paramName: "dzfile", // The name that will be used to transfer the file
  //autoProcessQueue: false,
  maxFilesize: 5, // MB
  clickable: true,
  addRemoveLinks: true,
  acceptedFiles: 'image/*',
  dictFallbackMessage: "{{__('admin/image.browser dont support drag drop and multi files')}}",
  // المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات
  dictInvalidFileType:"{{ __('admin.image.cant upload this type of files')}}",
  dictCancelUpload: "{{ __('admin/image.delete image') }}",
  dictCancelUploadConfirmation:"{{ __('admin/image.sure to cancel upload')}}",
  dictRemoveFile: "{{ __('admin/image.delete image') }}",
  dictMaxFilesExceeded: "{{ __('admin/images.cant upload this number of files') }}",
  headers: {
    'X-CSRF-TOKEN':
    "{{ csrf_token() }}"
  }

  ,
  url: "{{ route('admin.products.images.store',$product->id) }}",

  success:
    function (file, response) {
    $('form').append('<input type="hidden" name="document[]" value="' + response.original_name + '" >');
    file.fid=response.fid;
    $('.msg').html(response.msg);
    $('.msg').removeClass('hidden');
    console.log(response.msg)
  },
  removedfile: function (file) {
    if (confirm('Are you sure you want to delete this image ?')) {
      $.ajax({
        url:"{{ route('admin.products.images.delete')  }}",
        dataType:'json',
        type:'POST',
        data:{
          id:file.fid,
          _token:"{{ csrf_token() }}",
        },
        success:function (data, response){
          $('.msg').html(data.msg);
          $('.msg').removeClass('hidden');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // console.log(jqXHR);
        },
      });
      $('form').find('input[name="document[]"][value="' + file.name + '"]').remove();
      var fmock;
      return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
    }
  }
  ,
  init: function () {
    @if($product->images)
      @foreach($product->images as $file)
      var mock = {name: '{{ $file->photo }}',fid: '{{ $file->id }}',size: '',type: '' };
      this.emit('addedfile',mock);
      this.options.thumbnail.call(this,mock,
        "{{ $product->imagePath($file->photo) }}");
      $('form').append('<input type="hidden" name="document[]" value="{{ $file->photo }}">')
      @endforeach
    @endif
  }
  }
</script>
<style type="text/css">
  .dz-image img {
  width:150px;
  height:150px;
  }
</style>
@stop

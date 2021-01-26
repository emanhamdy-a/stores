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
                 أضافة منتج جديد
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
              <div class="alert alert-success msg m-auto col-10 text-center hidden"></div>
              <div class="card-content collapse show">
                <div class="card-body">
                  <form class="form"
                    action="{{route('admin.products.images.store.db')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id"
                      value="{{$product->id}}">
                    <div class="form-body">
                      <h4 class="form-section"><i class="ft-home"></i>
                       صور المنتج
                      </h4>
                      <div class="form-group">
                        <div id="dpz-multiple-files"
                          class="dropzone dropzone-area">
                          <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                        </div>
                        <br><br>
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1"
                          onclick="history.back();">
                        <i class="ft-x"></i>
                        {{ __('admin/product.cancel') }}
                      </button>
                      <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i>
                        {{ __('admin/product.save') }}
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
  dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
  dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
  dictCancelUpload: "الغاء الرفع ",
  dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
  dictRemoveFile: "حذف الصوره",
  dictMaxFilesExceeded: "لا يمكنك رفع عدد اكثر من هضا ",
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
    console.log(file.fid);
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

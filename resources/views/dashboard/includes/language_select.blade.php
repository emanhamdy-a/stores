<div class="col-12">
<div class="form-group">
  <label for="lang"> {{ __('language') }} </label>
  <select name="lang" class='form-control'>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <option value="{{ $localeCode }}"
      <?php
        if(old('lang')===$localeCode){
         echo 'selected';
        }elseif(!old('lang') && getLang()===$localeCode){
          echo 'selected';
        }
      ?>
      >{{ $properties['native'] }}</option>
    @endforeach
  </select>
</div>
</div>

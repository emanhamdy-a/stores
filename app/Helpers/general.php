<?php
define('PAGINATION_COUNT',50);
// define('ADMIN_PREFIX','admin');
if (!function_exists('getFolder')) {
	function getFolder() {
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
  }
}
if (!function_exists('getLang')) {
  function getLang() {
    return app()->getLocale();
  }
}

if (!function_exists('uploadImage')) {
  function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
 }
}


if (!function_exists('active_menu')) {
	function active_menu($link,$req_seg=null) {
    if($req_seg == null){

      if(Request::segment(3) == $link && $link == ''){
        return ['open', 'active'];
      }

      if (preg_match('/'.$link.'/i',Request::segment(3)) && $link !== '') {
        return ['open', 'active'];
      } else {
        return ['', ''];
      }

    }else{
      if (preg_match('/'.$link.'/i',Request::segment($req_seg))) {
        return ['open', 'active'];
      } else {
        return ['', ''];
      }
    }
	}
}

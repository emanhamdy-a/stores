<?php
define('PAGINATION_COUNT',15);
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

// if (!function_exists('unlink_image')) {
//   function unlink_image($image){
//     unlink($image);
//     return true;
//  }
// }

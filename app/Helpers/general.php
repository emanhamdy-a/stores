<?php

use App\Models\Category;

define('PAGINATION_COUNT',50);
define('PAGINATION_SEARCH',9);

define('MYFATOORAHBASEURL',"https://apitest.myfatoorah.com");

define('MYFATOORAHTOKEN','Tfwjij9tbcHVD95LUQfsOtbfcEEkw1hkDGvUbWPs9CscSxZOttanv3olA6U6f84tBCXX93GpEqkaP_wfxEyNawiqZRb3Bmflyt5Iq5wUoMfWgyHwrAe1jcpvJP6xRq3FOeH5y9yXuiDaAILALa0hrgJH5Jom4wukj6msz20F96Dg7qBFoxO6tB62SRCnvBHe3R-cKTlyLxFBd23iU9czobEAnbgNXRy0PmqWNohXWaqjtLZKiYY-Z2ncleraDSG5uHJsC5hJBmeIoVaV4fh5Ks5zVEnumLmUKKQQt8EssDxXOPk4r3r1x8Q7tvpswBaDyvafevRSltSCa9w7eg6zxBcb8sAGWgfH4PDvw7gfusqowCRnjf7OD45iOegk2iYSrSeDGDZMpgtIAzYVpQDXb_xTmg95eTKOrfS9Ovk69O7YU-wuH4cfdbuDPTQEIxlariyyq_T8caf1Qpd_XKuOaasKTcAPEVUPiAzMtkrts1QnIdTy1DYZqJpRKJ8xtAr5GG60IwQh2U_-u7EryEGYxU_CUkZkmTauw2WhZka4M0TiB3abGUJGnhDDOZQW2p0cltVROqZmUz5qGG_LVGleHU3-DgA46TtK8lph_F9PdKre5xqXe6c5IYVTk4e7yXd6irMNx4D4g1LxuD8HL4sYQkegF2xHbbN8sFy4VSLErkb9770-0af9LT29kzkva5fERMV90w');

// define('ADMIN_PREFIX','admin');
if (!function_exists('getFolder')) {
	function getFolder() {
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
  }
}


if (!function_exists('cats_menu')) {
	function cats_menu($link) {
    if(Request::segment(2) == $link && $link == ''){
      return ['active', 'act'];
    }else{
      return ['', ''];
    }
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


// if (!function_exists('basket')) {
//   function items_in_cart() {
//     // return session()->all();
//     return count(Session::get('basket'));
//   }
// }
if (!function_exists('getLang')) {
  function getLang() {
    return app()->getLocale();
  }
}

if (!function_exists('main_child_cats')) {
  function main_child_cats(){
    return $categories=Category::parent()->select('id', 'slug')->with(['childrens' =>
     function ($q) {
      $q->select('id', 'parent_id', 'slug');
      $q->with(['childrens' => function ($qq) {
         $qq->select('id', 'parent_id', 'slug');
      }]);
    }])->get();
  }
}

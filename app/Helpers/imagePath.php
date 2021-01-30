<?php

if (!function_exists('category_img')) {
  function category_img($filnm){
    return $filnm ? url('/') . "/images/categories/" . $filnm : '';
  }
}

if (!function_exists('brand_img')) {
  function brand_img($filnm){
    return $filnm ? url('/') . "/images/brands/" . $filnm : '';
  }
}

if (!function_exists('product_img')) {
  function product_img($filnm){
    return $filnm ? url('/') . "/images/products/" . $filnm : '';
  }
}

if (!function_exists('slider_img')) {
  function slider_img($filnm){
    return $filnm ? url('/') . "/images/sliders/" . $filnm : '';
  }
}

if (!function_exists('theme_img')) {
  function theme_img($filnm){
    return $filnm ? url('/') . "/assets/images/" . $filnm : '';
  }
}
if (!function_exists('slider_img')) {
  function slider_img($filnm){
    return $filnm ? url('/') . "/images/sliders/" . $filnm : '';
  }
}

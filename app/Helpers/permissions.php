<?php

if (!function_exists('permissions')) {
  function permissions(){
    $permissions= [
      'products'  => __('admin/permissions.products'),
      'tags'      => __('admin/permissions.tags'),
      'categories'=> __('admin/permissions.categories'),
      'brands'    => __('admin/permissions.brands'),
      'options'   => __('admin/permissions.options'),
      'admins'    => __('admin/permissions.admins'),
      'settings'  => __('admin/permissions.settings'),
      'profile'   => __('admin/permissions.profile'),
      'sliders'   => __('admin/permissions.sliders'),
      'attributes'=> __('admin/permissions.attributes'),
      'roles'     => __('admin/permissions.roles'),
    ];

    return $permissions;
  }
}

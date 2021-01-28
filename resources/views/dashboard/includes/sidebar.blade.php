<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

      <li class="nav-item {{ active_menu('')[1] }}">
        <a href="{{route('admin.dashboard') }}">
        <i class="la la-mouse-pointer"></i>
          <span
            class="menu-title" data-i18n="nav.add_on_drag_drop.main">
            {{ __('admin\sidebar.home') }}
          </span></a>
      </li>

      @can('language')
        <li class="nav-item {{ active_menu('language')[0] }}">
          <a href=""><i class="la la-home"></i>
            <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>
            <span
              class="badge badge badge-info badge-pill float-right mr-2"></span>
          </a>
          <ul class="menu-content {{ active_menu('language')[1] }}">
            <li class="active"><a class="menu-item" href=""
              data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="" data-i18n="nav.dash.crypto">
                لغة جيه </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('categories')
        <li class="nav-item {{ active_menu('main_categories')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main">
              {{ __('admin\sidebar.categories') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Category::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('main_categories')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.maincategories') }}"
              data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.maincategories.create') }}"
                data-i18n="nav.dash.crypto">{{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('brands')
        <li class="nav-item {{ active_menu('brands')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main">
              {{ __('admin\sidebar.brands') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Brand::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('brands')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.brands') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.brands.create') }}"
                data-i18n="nav.dash.crypto">{{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('tags')
        <li class="nav-item {{ active_menu('tags')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.tags') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Tag::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('tags')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.tags') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.tags.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('products')
        <li class="nav-item {{ active_menu('products')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.products') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Product::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('products')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.products') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.products.general.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('attributes')
        <li class="nav-item {{ active_menu('attributes')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.attributes') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Attribute::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('attributes')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.attributes') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.attributes.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('options')
        <li class="nav-item {{ active_menu('options')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.options') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Option::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('options')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.options') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.options.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('sliders')
        <li class="nav-item {{ active_menu('sliders')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.sliders') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Slider::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('sliders')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.sliders.create') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.sliders.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('roles')
        <li class="nav-item {{ active_menu('roles')[0] }}">
          <a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.roles') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Role::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('roles')[1] }}">
            <li class="">
              <a class="menu-item" href="{{route('admin.roles.index') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.roles.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('admins')
        <li class="nav-item {{ active_menu('admins')[0] }}"><a href=""><i class="la la-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> {{ __('admin\sidebar.users') }}</span>
            <span
              class="badge badge badge-danger badge-pill float-right mr-2">
              {{\App\Models\Admin::count()}}
            </span>
          </a>
          <ul class="menu-content {{ active_menu('admins')[1] }}">
            <li class=""><a class="menu-item" href="{{route('admin.admins.index') }}"
               data-i18n="nav.dash.ecommerce"> {{ __('admin\sidebar.show all') }} </a>
            </li>
            <li><a class="menu-item" href="{{route('admin.admins.create') }}"
                data-i18n="nav.dash.crypto">
                {{ __('admin\sidebar.add new') }} </a>
            </li>
          </ul>
        </li>
      @endcan

      @can('settings')
        <li class="nav-item {{ active_menu('settings')[0] }}"><a href="#">
          <i class="la la-television"></i><span class="menu-title"
            data-i18n="nav.templates.main">{{ active_menu('shipping-methods',4)[1] }} {{ __('admin/sidebar.settings') }}</span></a>
          <ul class="menu-content">
            <li class="nav-item {{ active_menu('shipping-methods',4)[0] }}">
              <a class="menu-item" href="#"
                  data-i18n="nav.templates.vert.main"> {{ __('admin/sidebar.shipping methods') }} </a>
              <ul class="menu-content">
                <li class="menu-item {{ active_menu('free',5)[1] }}">
                  <a class="menu-item"
                  href="{{route('edit.shippings.methods','free') }}"
                      data-i18n="nav.templates.vert.classic_menu">
                      {{ __('admin\sidebar.free shipping') }} </a>
                </li>
                <li class="menu-item {{ active_menu('inner',5)[1] }}">
                  <a class="menu-item" href="{{route('edit.shippings.methods','inner') }}">
                {{ __('admin\sidebar.inner shipping') }} </a>
                </li>
                <li class="menu-item {{ active_menu('outer',5)[1] }}">
                  <a class="menu-item" href="{{route('edit.shippings.methods','outer') }}"
                      data-i18n="nav.templates.vert.compact_menu">  {{ __('admin\sidebar.outer shipping') }} </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      @endcan

    </ul>
  </div>
</div>

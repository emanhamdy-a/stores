<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\AttributesController;
use App\Http\Controllers\Dashboard\OptionsController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\RolesController;

Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

  Route::group(['namespace'=>'Dashboard',
  'middleware'=>'auth:admin','prefix'=>'admin'],function(){

    // Route::get('/seeder', function() {
    // 	return view('heroku_db');
    // });

    Route::get('/seeder', function() {
      return view('seeder');
    });

    Route::get('/logout', [LoginController::class, 'logout'])
      ->name('admin.logout');

    Route::get('/',[DashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::group(['prefix'=>'settings' , 'middleware' => 'can:settings'],function(){

      Route::get('/shipping-methods/{type}',
      [SettingsController::class, 'editShippingMethods'])
      ->name('edit.shippings.methods');
      Route::put('/shipping-methods/{type}',
      [SettingsController::class, 'updateShippingMethods'])
      ->name('update.shippings.methods');

    });

    Route::group(['prefix'=>'profile' , 'middleware' => 'can:profile'],function(){

      Route::get('edit',[ProfileController::class, 'editProfile'])
      ->name('edit.profile');

      Route::put('update',[ProfileController::class, 'updateprofile'])
      ->name('update.profile');

    });

    #################### categories routes ####################

    Route::group(['prefix' => 'main_categories' , 'middleware' => 'can:categories'], function () {

      Route::get('/', [MainCategoriesController::class,'index'])
        ->name('admin.maincategories');
      Route::get('create', [MainCategoriesController::class,'create'])
        ->name('admin.maincategories.create');
      Route::post('store', [MainCategoriesController::class,'store'])
        ->name('admin.maincategories.store');
      Route::get('edit/{id}', [MainCategoriesController::class,'edit'])
        ->name('admin.maincategories.edit');

      Route::post('update/{id}',[MainCategoriesController::class, 'update'])
      ->name('admin.maincategories.update');

      Route::get('delete/{id}', [MainCategoriesController::class,'destroy'])
        ->name('admin.maincategories.delete');
    });
    ##################### end categories    #####################

    #####################  brands routes   ######################
    Route::group(['prefix' => 'brands' , 'middleware' => 'can:brands'],
    function () {
      Route::get('/', [BrandsController::class,'index'])
        ->name('admin.brands');
      Route::get('create', [BrandsController::class,'create'])
        ->name('admin.brands.create');
      Route::post('store', [BrandsController::class,'store'])
        ->name('admin.brands.store');
      Route::get('edit/{id}', [BrandsController::class,'edit'])
        ->name('admin.brands.edit');
      Route::post('update/{id}', [BrandsController::class,'update'])
        ->name('admin.brands.update');
      Route::get('delete/{id}', [BrandsController::class,'destroy'])
        ->name('admin.brands.delete');
    });
    ###################### end brands   #######################


    ###################### Tags tags    #######################
    Route::group(['prefix' => 'tags'  , 'middleware' => 'can:tags'],
    function () {
      Route::get('/', [TagsController::class,'index'])
        ->name('admin.tags');
      Route::get('create', [TagsController::class,'create'])
        ->name('admin.tags.create');
      Route::post('store', [TagsController::class,'store'])
        ->name('admin.tags.store');
      Route::get('edit/{id}', [TagsController::class,'edit'])
        ->name('admin.tags.edit');
      Route::post('update/{id}', [TagsController::class,'update'])
        ->name('admin.tags.update');
      Route::get('delete/{id}', [TagsController::class,'destroy'])
        ->name('admin.tags.delete');
    });
    ###################### end tags  ######################

    ###################### products routes ################
    Route::group(['prefix' => 'products' , 'middleware' => 'can:products'], function () {
      Route::get('/', [ProductsController::class,'index'])
        ->name('admin.products');

      Route::get('general-information', [ProductsController::class,'create'])
        ->name('admin.products.general.create');
      Route::post('store-general-information'
        , [ProductsController::class,'store'])
        ->name('admin.products.general.store');
      Route::get('edit/{id}', [ProductsController::class,'edit'])
      ->name('admin.products.edit');
      Route::get('delete/{id}', [ProductsController::class,'destroy'])
      ->name('admin.products.delete');
      Route::post('update/{id}', [ProductsController::class,'update'])
      ->name('admin.products.general.update');

      Route::get('price/{id}', [ProductsController::class,'getPrice'])
        ->name('admin.products.price');
      Route::post('price', [ProductsController::class,'saveProductPrice'])
        ->name('admin.products.price.store');


      Route::get('stock/{id}', [ProductsController::class,'getStock'])
        ->name('admin.products.stock');
      Route::post('stock', [ProductsController::class,'saveProductStock'])
        ->name('admin.products.stock.store');

      Route::get('images/{id}', [ProductsController::class,'addImages'])
        ->name('admin.products.images');
      Route::post('images/{id}', [ProductsController::class,'saveProductImages'])
        ->name('admin.products.images.store');
      Route::post('delete/images', [ProductsController::class,'deleteImage'])
        ->name('admin.products.images.delete');
    });
    ##################### end products  ###################

    ####################### attrributes routes ################
    Route::group(['prefix' => 'attributes' , 'middleware' => 'can:attributes'], function () {
      Route::get('/', [AttributesController::class,'index'])
        ->name('admin.attributes');
      Route::get('create', [AttributesController::class,'create'])
        ->name('admin.attributes.create');
      Route::post('store', [AttributesController::class,'store'])
        ->name('admin.attributes.store');
      Route::get('delete/{id}', [AttributesController::class,'destroy'])
        ->name('admin.attributes.delete');
      Route::get('edit/{id}', [AttributesController::class,'edit'])
        ->name('admin.attributes.edit');
      Route::post('update/{id}', [AttributesController::class,'update'])
        ->name('admin.attributes.update');
    });
    ####################  end attributes  ####################

    #################### attributes options #######################
    Route::group(['prefix' => 'options'], function () {
      Route::get('/' , [OptionsController::class,'index'])->
        name('admin.options');
      Route::get('create' , [OptionsController::class,'create'])->
        name('admin.options.create');
      Route::post('store' , [OptionsController::class,'store'])->
        name('admin.options.store');
        ///
      Route::get('delete/{id}',[OptionsController::class,'destroy'])
         -> name('admin.options.delete');
      Route::get('edit/{id}' , [OptionsController::class,'edit'])->
        name('admin.options.edit');
      Route::post('update/{id}' , [OptionsController::class,'update'])->
        name('admin.options.update');
    });
    #################### end attributes options  ##################

    #################### sliders #######################
    Route::group(['prefix' => 'sliders' , 'middleware' => 'can:sliders'], function () {
      Route::get('/', [SliderController::class,'addImages'])
        ->name('admin.sliders.create');
      Route::post('images', [SliderController::class,'saveSliderImages'])
        ->name('admin.sliders.images.store');
      Route::post('delete/images', [SliderController::class,'deleteImage'])->name('admin.sliders.images.delete');

    });
    #################### end sliders  #########################

    #################### roles ########################
    Route::group(['prefix' => 'roles' , 'middleware' => 'can:roles'], function () {
      Route::get('/', [RolesController::class,'index'])
        ->name('admin.roles.index');
      Route::get('create', [RolesController::class,'create'])
        ->name('admin.roles.create');
      Route::post('store', [RolesController::class,'saveRole'])
        ->name('admin.roles.store');
      Route::get('/edit/{id}', [RolesController::class,'edit']) ->name('admin.roles.edit') ;
      Route::post('update/{id}', [RolesController::class,'update'])
        ->name('admin.roles.update');
      Route::get('delete/{id}',[RolesController::class,'destroy'])
      -> name('admin.roles.delete');
      });
    #################### end roles ########################


    /**
     * admins Routes
     */
    Route::group(['prefix' => 'admins' , 'middleware' => 'can:admins'], function () {
      Route::get('/', [AdminsController::class,'index'])
        ->name('admin.admins.index');
      Route::get('/create', [AdminsController::class,'create'])
        ->name('admin.admins.create');
      Route::post('/store', [AdminsController::class,'store'])
        ->name('admin.admins.store');
      Route::get('/edit/{id}', [AdminsController::class,'edit'])
        ->name('admin.admins.edit') ;
      Route::post('update/{id}', [AdminsController::class,'update'])
        ->name('admin.admins.update');
      Route::get('delete/{id}',[AdminsController::class,'destroy'])
        -> name('admin.admins.delete');
    });

  });


  Route::group(['namespace'=>'Dashboard','prefix'=>'admin',
  'middleware'=>'guest:admin'],function(){

    Route::get('/login',[LoginController::class, 'login'])
    ->name('admin.login');

    Route::post('/postlogin',[LoginController::class, 'postlogin'])
    ->name('admin.post.login');

  });

});

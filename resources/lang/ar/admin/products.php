<?php

return [
  //general
  'products'                =>   'كل المنتجات',
  'add product'             =>   'اضف منتج جديد',
  'product data'            =>   'بيانات المنتج',
  'name'                    =>   'الاسم',
  'slug'                    =>   'الاسم بالرابط',
  'price'                   =>   'السعر',
  'images'                  =>   'الصور',
  'store'                   =>   'المخزن',
  'delete'                  =>   'حذف',
  'edit'                    =>   'تعديل',
  'active'                  =>   'مفعل',
  'not active'              =>   'غير مفعل',
  'update product'          =>   'تحديث',
  'view'                    =>   'معاينه',
  'other data'              =>   'البيانات الاخري',
  'actions'                 =>   'الاجراءات',
  'discreption'             =>   'الوصف',
  'small discreption'       =>   'وصف مختصر',
  'choose category'         =>   'اختر القسم',
  'please choose category'  =>   'من فضلك اختر القسم',
  'choose tag'              =>   'حدد العلامات المرجعيه',
  'please choose tag'       =>   'من فضلك حدد العلامات المرجعيه',
  'choose brand'            =>   'حدد الماركه',
  'please choose brand'     =>   'من فضلك حدد الماركه',
  'status'                  =>   'الحاله',
  'save'                    =>   'حفظ',
  'cancel'                  =>   'الغاء',
  //images
  'delete image'            =>   'حذف الصوره',
  'product image deleted'   =>   'تم حذف صوره المنتج',
  'manage images'           =>   'اداره الصور',
  'product images'          =>   'صور المنتج',
  'upload images'           =>   'حدد الصور لرفعها',
  //price
  'product price'           =>   'سعر المنتج',
  'product price data'      =>   'بيانات سعر المنتج',
  'specieal price'          =>   'السعر الخاص',
  'start date'              =>   'تاريخ البدايه',
  'end date'                =>   'تاريخ الانتهاء',
  //stock
  'manage store'            =>   'اداره المخزن',
  'product code'            =>   'كود المنتج',
  'trace store'             =>   'متابعه المنتج في المخزن',
  'dont allow track'        =>   'عدم السماح بالتتبع',
  'allow track'             =>   'السماح بالتتبع',
  'product status'          =>   'حاله المنتج',
  'please choose'           =>   'اختر من فضلك',
  'please choose type'      =>   'من فضلك حدد النوع',
  'available'               =>   'متاح',
  'not available'           =>   'غير متاح',
  'quantity'                =>   'الكميه',
  //controller
  'product added'           =>   'تم اضافه منتج جديد بنجاح',
  'try later'               =>   'شيئا ما خطا حدث من فضلك اعد المحاوله',
  'not found'               =>   'المنتج غير موجود',
  'product updated'         =>   'تم تحديث بيانات المنتج بنجاح',
  'product deleted'         =>   'تم حذف المنتج بنجاح',
  'product image deleted'   =>   'تم حذف صوره المنتج بنجاح',
  //validation general
  'name required'              =>  'من فضلك ادخل اسم المنتج',
  'name max'                   =>  'اسم النتج لا يجب ان يعدي 100 حرف',
  'slug required'              =>  'من فضلك ادخل الاسم بالرابط',
  'slug unique'                =>  'هذا الاسم بالرابط مستخدم من قبل',
  'unique slug'                =>  'هذا الاسم بالرابط مستخدم من قبل',
  'description required'       =>  'من فضلك ادخل وصف المنتج',
  'description max'            =>  'وصف المنتج يجب ال يتعدي علي 1000 حرف',
  'short description max'      =>  'الوصف المختصر يجب الا يتعدي 500 حرف',
  'categories'                 =>  'من فضلك حدد الاقسام التي ينتمي اليها المنتج',
  'tags'                       =>  'يجب ان تحدد العلامات التي ينتمي اليها المنتج',
  'brand required'             =>  'يجب ان تقوم بتحديد ماركه المنتج',
  'image required'             =>  'صوره المنتج مطلوبه',
  'product main image'         =>  'صوره المنتج الرئيسيه',
  'image image'                =>  'يجب ان يكون الملف صوره',
  'image mimes'                =>  'يجب ان تكون للصوره احد تلك الامتدادات : ' .config('image.extends'),
  'image max size'             =>  'حجم الصوره لا يجب ان يتعدي  : ' .config("image.size"),
  //validation price
  'price required'         => 'من فضلك ادخل السعر',
  // 'price min'              => 'Price min length',
  'price numeric'          => 'يجب ان يكون السعر رقم',
  'special_price numeric'  => 'السعر الخاص يجب ان يكون رقم',
  'special_price_type'     => 'من فضلك ادخل السعر الخاص',
  'special_price_start'    => 'من فضلك ادخل تاريخ بدايه السعر الخاص',
  'special_price_end'      => 'من فضلك ادخل تاريخ نهايه السعر الخاص',
  //validation stock
  'Product code required'  => 'من فضلك ادخل كود المنتج',
  'Product code min'       => 'كود المنتج يجب الا يقل عن 3 احرف',
  'Product code max'       => 'كود المنتج يجب الا يتعدي 3 احرف',
  'manage_stock required'  => 'من فضلك ادخل كميه المنتج',
  'in_stock required'      => 'من فضلك حدد مدي توفر المنتج',
  'qty'                    => 'من فضلك ادخل كميه المنتج',
];



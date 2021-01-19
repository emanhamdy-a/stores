<?php


namespace App\Repositories;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Http\Interfaces\ProcuctRepositoryInterface;

class ProductRepository implements ProcuctRepositoryInterface
{
    public function all()
    {
      return Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
    }

    public function create()
    {
      $data = [];
      $data['brands'] = Brand::active()->select('id')->get();
      $data['tags'] = Tag::select('id')->get();
      $data['categories'] = Category::active()->select('id')->get();
      return $data;
    }

    public function store($request)
    {

      $this->setlocale($request);

      $request = $this->is_active($request);

      $product = Product::create([
        'slug' => $request->slug,
        'brand_id' => $request->brand_id,
        'is_active' => $request->is_active,
        'short_description' => $request->short_description,
      ]);
      //save translations
      $product->name = $request->name;
      $product->description = $request->description;
      $product->short_description = $request->short_description;
      $product->save();
      //save product categories
      $product->categories()->attach($request->categories);
      //save product tags
      $product->tags()->attach($request->tags);
    }

    public function edit($product)
    {
      $data = [];
      $data['product']=$product;
      $data['brands'] = Brand::active()->select('id')->get();
      $data['tags'] = Tag::select('id')->get();
      $data['categories'] = Category::active()->select('id')->get();
      return $data;
    }

    public function update($id,$request)
    {
      $product=Product::findOrFail($id);

      $this->setlocale($request);

      $request = $this->is_active($request);

      $product->update([
        'slug' => $request->slug,
        'brand_id' => $request->brand_id,
        'is_active' => $request->is_active,
        'short_description' => $request->short_description,
      ]);
      //save translations
      $product->name = $request->name;
      $product->description = $request->description;
      $product->short_description = $request->short_description;
      $product->save();
      //save product categories
      $product->categories()->attach($request->categories);
      //save product tags
      $product->tags()->attach($request->tags);
    }

    public function savePrice($request)
    {
      Product::whereId($request -> product_id) -> update($request -> only(['price','special_price','special_price_type','special_price_start','special_price_end']));
    }

    public function saveStock($request)
    {
      Product::whereId($request -> product_id) -> update($request -> except(['_token','product_id']));
    }

    public function show($id)
    {
      return Product::findOrFail($id);
    }

    public function delete($product,$id)
    {
      return $product->delete();
    }


    // add is active to request if is active
    public function is_active($request){
      if (!$request->has('is_active'))
        $request->request->add(['is_active' => '0']);
      else
        $request->request->add(['is_active' => '1']);
      return $request;
    }

    //if request has lang set locale to this lang
    public function setlocale($request){
      if ($request->has('lang')){
        app()->setLocale($request->lang);
      }
    }
}

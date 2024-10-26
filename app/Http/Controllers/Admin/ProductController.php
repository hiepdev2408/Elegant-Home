<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with([
            'variants.attributes' => function ($query) {
                $query->with('attribute', 'attributeValue');
            }
        ])->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $attributes = Attribute::all();
        $category = Category::query()->pluck('name', 'id')->all();

        return view('admin.products.create', compact('attributes', 'category'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::transaction(function ()use ($request) {
                $dataProduct = $request->except(['product_galleries', 'variants', 'categories']);

                // dd($dataProduct);
                $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
                $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
                $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
                $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
                $dataProduct['slug'] = Str::slug($dataProduct['name']);

                if($request->hasFile('img_thumbnail')){
                    $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
                }

                $product = Product::query()->create($dataProduct);

                foreach ($request->product_galleries as $imageGallery) {
                    Gallery::query()->create([
                        'product_id' => $product->id,
                        'img_path' => $imageGallery,
                    ]);
                }
                // dd($request->variants);
                foreach ($request->variants as $variantData) {
                    if (!empty($variantData['sku'])) {
                        $variant = Variant::query()->create([
                            'product_id' => $product->id,
                            'sku' => $variantData['sku'] ?? 0,
                            'stock' => $variantData['stock'],
                            'price_modifier' =>  $variantData['price_modifier'] ?? 0,
                            'image' => Storage::put('variants', $variantData['image']),
                        ]);
                    }
                    // dd($variant);
                    if (!empty($variantData['attributes'])) {
                        foreach ($variantData['attributes'] as $key => $value) {
                            // dd($value);
                            if($value){
                                $variant->attributes()->create([
                                    'attribute_id' => $key,
                                    'attribute_value_id' => $value,
                                ]);
                            }
                        }
                    }
                }

                $product->categories()->attach($request->categories);
            }, 3);

            return redirect()->route('products.index')->with('success', 'Thao tác thành công');
        } catch (\Exception $exception) {
            dd($exception->getMessage());

            return back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::query()->findOrFail($id);

        $attributes = Attribute::with('values')->get(); // Lấy tất cả thuộc tính và giá trị
        $product->load(['galleries', 'variants.attributes']);

        return view('admin.products.edit', compact('product', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);
        try {
            DB::transaction(function () use ($product) {

                $product->productAttributes()->delete();
                foreach ($product->productAttributes as $productAttribute) {
                    $group = $productAttribute->group;
                    $group->delete();
                }

                $product->galleries()->delete();

                $product->categories()->sync([]);

                $product->delete();
            });

            return back()->with('success', 'Thao tác thành công!');
        } catch (\Exception $exception) {
            dd($exception->getMessage());

            return back();
        }
    }
}

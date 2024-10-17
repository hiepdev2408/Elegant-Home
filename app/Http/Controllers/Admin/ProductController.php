<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductAttribute;
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
        $products = Product::with(['categories','galleries','productAttributes.group'])->latest('id')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attribute = Attribute::query()->pluck('name', 'id')->all();
        $category = Category::query()->pluck('name', 'id')->all();

        return view('admin.products.create', compact('attribute', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->product_galleries);
        try {
            DB::transaction(function () use ($request){

                $data = $request->except(['product_attribute', 'group', 'product_galleries', 'categories']);
                $data['is_active'] = isset($data['is_active']) ? 1 : 0;
                $data['is_good_deal'] = isset($data['is_good_deal']) ? 1 : 0;
                $data['is_new'] = isset($data['is_new']) ? 1 : 0;
                $data['is_show_home'] = isset($data['is_show_home']) ? 1 : 0;
                $data['slug'] = Str::slug($data['name']);

                // dd($data['img_thumbnail']);
                if($request->hasFile('img_thumbnail')){
                    $data['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
                }

                $product = Product::create($data);

                // Sử lý gallery
                foreach ($request->product_galleries as $image) {
                    Gallery::create([
                        'product_id' => $product->id,
                        'img_path' => Storage::put('galleries', $image),
                    ]);
                }

                // Sử lý group
                foreach ($request->group as $key => $dataGroup) {
                    $group = Group::query()->create([
                        'SKU' => $dataGroup['SKU'],
                        'stock' => $dataGroup['stock'],
                        'price' => $dataGroup['price'],
                        'price_sale' => $dataGroup['price_sale'],
                        'img_variant' => Storage::put('group', $dataGroup['img_variant']),
                    ]);

                    foreach ($request->product_attribute['attribute_id'][$key] as $proAttriIndex => $productAttributeValue) {
                        $valueProductAttribute = $request->product_attribute['value'][$key][$proAttriIndex];

                        $productAttribute = ProductAttribute::create([
                            'product_id' => $product->id,
                            'attribute_id' => $productAttributeValue,
                            'group_id' => $group->id,
                            'value' => $valueProductAttribute,
                        ]);
                    }
                }
                $product->categories()->sync($request->categories);

            },1);

            return redirect()->route('products.index')->with('success', 'Thêm mới thành công!');
        } catch (\Exception $exception) {
            dd($exception->getMessage());

            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::query()->findOrFail($id);

        $attribute = Attribute::query()->pluck('name', 'id')->all();
        $category = Category::query()->pluck('name', 'id')->all();
        $proCate = $product->categories()->pluck('id')->all();

        return view('admin.products.edit', compact('product','category', 'attribute', 'proCate'));
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
            DB::transaction(function () use ($product){

                foreach ($product->productAttributes as $productAttribute) {
                    $group = $productAttribute->group;

                    $productAttribute->delete();

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

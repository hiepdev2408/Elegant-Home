<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    const OBJECT = 'products';

    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }

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
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
            // Thực hiện logic khi có quyền
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $attributes = Attribute::all();
        $category = Category::query()->pluck('name', 'id')->all();

        return view('admin.products.create', compact('attributes', 'category'));
    }

    public function store(ProductRequest $request)
    {
        // dd($request->all());
        $dataProduct = $request->validated();

        try {

            DB::transaction(function () use ($request) {
                $dataProduct = $request->except(['product_galleries', 'variants', 'categories']);


                $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
                $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
                $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
                $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
                $dataProduct['slug'] = Str::slug($dataProduct['name']);

                if ($request->hasFile('img_thumbnail')) {
                    $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
                }

                $product = Product::query()->create($dataProduct);

                if (!empty($request->product_galleries)) {
                    foreach ($request->product_galleries as $imageGallery) {
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'img_path' => Storage::put('galleries', $imageGallery),
                        ]);
                    }
                }

                foreach ($request->variants as $variantData) {
                    if (!empty($variantData['sku'])) {
                        $variant = Variant::query()->create([
                            'product_id' => $product->id,
                            'sku' => $variantData['sku'] ?? 0,
                            'stock' => $variantData['stock'],
                            'price_modifier' => $variantData['price_modifier'] ?? 0,
                            'image' => Storage::put('variants', $variantData['image']),
                        ]);
                    }

                    if (!empty($variantData['attributes'])) {
                        foreach ($variantData['attributes'] as $key => $value) {
                            // dd($value);
                            if ($value) {
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
    public function show(string $id)
    {
        $product = Product::query()->findOrFail($id);
        $attributes = Attribute::with('values')->get(); // Lấy tất cả thuộc tính và giá trị
        $product->load(['galleries', 'variants.attributes', 'comments']);
        return view('admin.products.show', compact('product', 'attributes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::query()->with(['galleries', 'variants.attributes'])->findOrFail($id);

        $category = Category::query()->pluck('name', 'id')->all();
        $attributes = Attribute::with('values')->get();
        $categoryProduct = $product->categories->pluck('id')->all();

        // dd($product);
        return view('admin.products.edit', compact('product', 'attributes', 'category', 'categoryProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $product = Product::findOrFail($id);

                $dataProduct = $request->except(['product_galleries', 'variants', 'categories']);
                $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
                $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
                $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
                $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
                $dataProduct['slug'] = Str::slug($dataProduct['name']);

                $dataProduct['img_thumbnail'] = $product->img_thumbnail;

                if ($request->hasFile('img_thumbnail')) {
                    if ($product->img_thumbnail) {
                        Storage::delete($product->img_thumbnail);
                    }
                    $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
                }

                $product->update($dataProduct);

                if ($request->hasFile('img_thumbnail')) {
                    $thumbnailPath = $request->file('img_thumbnail')->store('products/thumbnails', 'public');
                    $product->update(['img_thumbnail' => $thumbnailPath]);
                }

                if ($request->hasFile('product_galleries')) {
                    foreach ($request->file('product_galleries') as $key => $file) {
                        if (Str::startsWith($key, 'new_')) {
                            $path = $file->store('products/galleries', 'public');
                            $product->galleries()->create(['img_path' => $path]);
                        } else {
                            $gallery = $product->galleries()->find($key);
                            if ($gallery) {
                                $path = $file->store('products/galleries', 'public');
                                $gallery->update(['img_path' => $path]);
                            }
                        }
                    }
                }

                if ($request->has('variants')) {
                    foreach ($request->input('variants') as $key => $variantData) {
                        // Kiểm tra xem chuỗi bắt đầu từ 1 hay nhiều
                        if (Str::startsWith($key, 'new_')) {
                            $newVariant = $product->variants()->create([
                                'sku' => $variantData['sku'],
                                'price_modifier' => $variantData['price_modifier'],
                                'stock' => $variantData['stock'],
                                'image' => '',
                            ]);

                            if ($request->hasFile("variants.$key.image")) {
                                $imagePath = $request->file("variants.$key.image")->store('products/variants', 'public');
                                $newVariant->update(['image' => $imagePath]);
                            }

                            if (!empty($variantData['attributes'])) {
                                foreach ($variantData['attributes'] as $attributeId => $valueId) {
                                    if ($valueId) {
                                        $newVariant->attributes()->create([
                                            'attribute_id' => $attributeId,
                                            'attribute_value_id' => $valueId,
                                        ]);
                                    }
                                }
                            }
                        } else {
                            $variant = $product->variants()->find($key);
                            if ($variant) {
                                $variant->update([
                                    'sku' => $variantData['sku'],
                                    'price_modifier' => $variantData['price_modifier'],
                                    'stock' => $variantData['stock'],
                                ]);

                                if ($request->hasFile("variants.$key.image")) {
                                    $imagePath = $request->file("variants.$key.image")->store('products/variants', 'public');
                                    $variant->update(['image' => $imagePath]);
                                }

                                $variant->attributes()->delete();

                                foreach ($variantData['attributes'] as $attributeId => $valueId) {

                                    if ($valueId) {
                                        $variant->attributes()->create([
                                            'attribute_id' => $attributeId,
                                            'attribute_value_id' => $valueId,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            });
            return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $exception) {
            dd($exception->getMessage());

            return back();
        }
    }



    public function warehouse()
    {
        $products = Product::with([
            'variants.attributes' => function ($query) {
                $query->with('attribute', 'attributeValue');
            }
        ])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    public function UpdateStock(Variant $variant, Request $request)
    {
        // dd($request->all());
        // lấy số lượng hiện tại
        $currentStock = $variant->stock;
        $addlStock = $request->input('stock');

        // Cập nhật số lượng tồn kho mới
        $variant->stock = $currentStock + $addlStock;
        $variant->save();

        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
    }

    public function compose(View $view)
    {
        $notifications = Notification::orderByDesc('created_at')->get();
        $unread = Notification::where('is_read', 0)->count();
        $view->with([
            'notifications' =>
            $notifications,
            'unread' =>
            $unread
        ]);
    }
}

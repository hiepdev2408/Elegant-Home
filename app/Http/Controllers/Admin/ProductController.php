<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->authorize('modules', '' . self::OBJECT . '.' . __FUNCTION__);

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
        $this->authorize('modules', '' . self::OBJECT . '.' . __FUNCTION__);
        $attributes = Attribute::all();
        $category = Category::query()->pluck('name', 'id')->all();

        return view('admin.products.create', compact('attributes', 'category'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
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

        if ($variant->stock < 5) {
            Notification::create([
                'title' => 'Tồn kho dưới định mức',
                'message' => "Sản phẩm: {$variant->product->name} sắp hết hàng! Số lượng: {$variant->quantity}",
            ]);
        }

        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
    }

    public function compose(View $view)
    {
        $notifications = Notification::orderByDesc('created_at')->get();
        $view->with('notifications', $notifications);
    }

}

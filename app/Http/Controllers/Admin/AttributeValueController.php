<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    protected $relations = ['attribute'];

    use TraitCRUD;

    public function __construct(
        protected AttributeValue $model
    ) {}

    public function create()
    {
        $attributes  = Attribute::query()->pluck('name', 'id')->all();
        return view('admin.attribute_values.create', compact('attributes'));
    }
    public function edit($id)
    {
        $attributeValue = $this->model->findOrFail($id);
        $attributes = Attribute::query()->pluck('name', 'id')->all();

        return view('admin.attribute_values.edit', compact('attributeValue', 'attributes'));
    }
}

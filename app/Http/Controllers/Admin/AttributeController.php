<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Traits\TraitCRUD;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    use TraitCRUD;

    protected $relations = ['category'];

    public function __construct(
        protected Attribute $model
    ){

    }

    public function create(){
        $categories = Category::query()->pluck('name', 'id')->all();

        return view('admin.attributes.create', compact('categories'));
    }

    public function edit($id){
        $attribute = Attribute::findOrFail($id);
        $categories = Category::query()->pluck('name', 'id')->all();

        return view('admin.attributes.edit', compact('categories', 'attribute'));
    }
}

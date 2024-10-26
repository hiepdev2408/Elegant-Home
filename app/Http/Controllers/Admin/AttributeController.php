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

    public function __construct(
        protected Attribute $model
    ){

    }
}

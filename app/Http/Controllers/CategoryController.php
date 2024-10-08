<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use TraitCRUD;

    protected $relations = [
        'parent'
    ];

    public function __construct( protected Category $model){}

}

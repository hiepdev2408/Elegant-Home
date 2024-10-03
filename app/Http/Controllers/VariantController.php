<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    use TraitCRUD;

    public function __construct( protected Variant $model){

    }
}

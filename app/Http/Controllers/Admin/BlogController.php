<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use TraitCRUD;

    protected $relations = [
        'user'
    ];

    public function __construct(protected Blog $model) {}
}

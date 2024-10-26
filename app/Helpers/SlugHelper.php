<?php

use Illuminate\Support\Str;

if (!function_exists('slugify')) {
    function slugify($name)
    {
        return Str::slug($name);
    }
}

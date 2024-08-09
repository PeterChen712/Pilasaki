<?php

namespace App\Http\Controllers;

use App\Models\WasteCategory;
use Illuminate\Http\Request;

class WasteCategoryController extends Controller
{
    public function getCategoryInfo($className)
    {
        $categoryInfo = WasteCategory::where('class_name', $className)->first();
        return response()->json($categoryInfo);
    }
}

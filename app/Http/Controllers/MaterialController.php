<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('category')->latest()->paginate(10);
        $categories = MaterialCategory::all();
        return view('materials.index', compact('materials', 'categories'));
    }

    public function show($slug)
    {
        $material = Material::where('slug', $slug)->firstOrFail();
        return view('materials.show', compact('material'));
    }

    public function byCategory($slug)
    {
        $category = MaterialCategory::where('slug', $slug)->firstOrFail();
        $materials = $category->materials()->paginate(10);
        return view('materials.by_category', compact('materials', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $materials = Material::where('title', 'like', "%$query%")
                             ->orWhere('description', 'like', "%$query%")
                             ->paginate(10);
        return view('materials.search', compact('materials', 'query'));
    }
}
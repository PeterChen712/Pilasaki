<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MaterialCategoryController extends Controller
{
    public function index()
    {
        $categories = MaterialCategory::all();
        return view('admin.material-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.material-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:material_categories,slug',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', // Allow for image upload
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('material-categories', 'public');
        }

        MaterialCategory::create($data);

        return redirect()->route('admin.material-categories.index')->with('success', 'Material category created successfully.');
    }

    public function edit(MaterialCategory $materialCategory)
    {
        return view('admin.material-categories.edit', compact('materialCategory'));
    }

    public function update(Request $request, MaterialCategory $materialCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:material_categories,slug,' . $materialCategory->id,
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', // Allow for image upload
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($materialCategory->photo) {
                Storage::disk('public')->delete($materialCategory->photo);
            }
            $data['photo'] = $request->file('photo')->store('material-categories', 'public');
        }

        $materialCategory->update($data);

        return redirect()->route('admin.material-categories.index')->with('success', 'Material category updated successfully.');
    }

    public function destroy(MaterialCategory $materialCategory)
    {
        // Delete associated photo
        if ($materialCategory->photo) {
            Storage::disk('public')->delete($materialCategory->photo);
        }
        
        $materialCategory->delete();
        return redirect()->route('admin.material-categories.index')->with('success', 'Material category deleted successfully.');
    }
}

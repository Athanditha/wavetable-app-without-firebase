<?php

namespace App\Http\Controllers;

use App\Models\EquipmentCategory;
use Illuminate\Http\Request;
use App\Http\Resources\EquipmentCategoryResource;

class EquipmentCategoryController extends Controller
{
    /**
     * Display a listing of the equipment categories.
     */
    public function index()
    {
        $categories = EquipmentCategory::all();
        
        return EquipmentCategoryResource::collection($categories);
        
    }

    /**
     * Store a newly created equipment category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $category = EquipmentCategory::create($validated);

        return new EquipmentCategoryResource($category);
    }

    /**
     * Display the specified equipment category.
     */
    public function show(EquipmentCategory $equipmentCategory)
    {
        $equipmentCategory->load('equipment');

        return new EquipmentCategoryResource($equipmentCategory);
    }

    /**
     * Update the specified equipment category in storage.
     */
    public function update(Request $request, EquipmentCategory $equipmentCategory)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string|max:1000',
        ]);

        $equipmentCategory->update($validated);

        return new EquipmentCategoryResource($equipmentCategory);
    }

    /**
     * Remove the specified equipment category from storage.
     */
    public function destroy(EquipmentCategory $equipmentCategory)
    {
        $equipmentCategory->delete();

        return response()->json(['message' => 'Equipment category deleted successfully'], 204);
    }
    
}

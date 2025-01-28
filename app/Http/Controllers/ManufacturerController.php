<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Resources\ManufacturerResource;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the manufacturers.
     * 
     */
    public function index()
    {
        $manufacturers = Manufacturer::all();

        return ManufacturerResource::collection($manufacturers);
    }

    /**
     * Store a newly created manufacturer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $manufacturer = Manufacturer::create($validated);

        return new ManufacturerResource($manufacturer);
    }

    /**
     * Display the specified manufacturer.
     */
    public function show(Manufacturer $manufacturer)
    {
        return new ManufacturerResource($manufacturer);
    }

    /**
     * Update the specified manufacturer in storage.
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $manufacturer->update($validated);

        return new ManufacturerResource($manufacturer);
    }

    /**
     * Remove the specified manufacturer from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return response()->json(['message' => 'Manufacturer deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();

        return LocationResource::collection($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'coordinates' => 'nullable|array',
            'coordinates.lat' => 'required_with:coordinates|numeric|between:-90,90',
            'coordinates.lng' => 'required_with:coordinates|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'working_hours' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $location = Location::create($validate);

        return new LocationResource($location);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::findOrFail($id);

        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $location = Location::findOrFail($id);

        $validate = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'coordinates' => 'nullable|array',
            'coordinates.lat' => 'required_with:coordinates|numeric|between:-90,90',
            'coordinates.lng' => 'required_with:coordinates|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'working_hours' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $location->update($validate);

        return new LocationResource($location->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        return response()->json([
            'success' => true,
            'message' => 'Location deleted successfully',
        ]);
    }
}

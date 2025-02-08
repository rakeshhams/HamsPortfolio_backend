<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeBusinessUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class NewHomeController extends Controller
{
    use HelperTrait;

    // Fetch All Home Business Units
    public function getAllBusinessUnits()
    {
        $businessUnits = HomeBusinessUnit::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Business units retrieved successfully',
            'data' => $businessUnits,
        ], 200);
    }

    // Fetch Business Unit by ID
    public function getBusinessUnitById($id)
    {
        $businessUnit = HomeBusinessUnit::find($id);

        if (!$businessUnit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Business unit not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Business unit retrieved successfully',
            'data' => $businessUnit,
        ], 200);
    }

    // Create Business Unit
    public function createBusinessUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('title', 'short_description', 'description', 'link');

        if ($request->hasFile('image_one')) {
            $data['image_one'] = $this->imageUpload($request, 'image_one', 'home_business_units');
        }

        if ($request->hasFile('image_two')) {
            $data['image_two'] = $this->imageUpload($request, 'image_two', 'home_business_units');
        }

        $businessUnit = HomeBusinessUnit::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Business unit created successfully',
            'data' => $businessUnit,
        ], 201);
    }

    // Update Business Unit
    public function updateBusinessUnit(Request $request, $id)
    {
        $businessUnit = HomeBusinessUnit::find($id);

        if (!$businessUnit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Business unit not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $businessUnit->fill($request->only('title', 'short_description', 'description', 'link'));

        if ($request->hasFile('image_one')) {
            $businessUnit->image_one = $this->imageUpload($request, 'image_one', 'home_business_units');
        }

        if ($request->hasFile('image_two')) {
            $businessUnit->image_two = $this->imageUpload($request, 'image_two', 'home_business_units');
        }

        $businessUnit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Business unit updated successfully',
            'data' => $businessUnit,
        ], 200);
    }

    // Delete Business Unit
    public function deleteBusinessUnit($id)
    {
        $businessUnit = HomeBusinessUnit::find($id);

        if (!$businessUnit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Business unit not found',
            ], 404);
        }

        if ($businessUnit->image_one) {
            \Storage::disk('public')->delete($businessUnit->image_one);
        }

        if ($businessUnit->image_two) {
            \Storage::disk('public')->delete($businessUnit->image_two);
        }

        $businessUnit->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Business unit deleted successfully',
        ], 200);
    }

    
}

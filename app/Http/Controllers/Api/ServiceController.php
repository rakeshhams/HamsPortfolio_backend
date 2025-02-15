<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class ServiceController extends Controller
{
    use HelperTrait;

    // Fetch All Service Categories
    public function getAllServiceCategories()
    {
        $categories = ServiceCategory::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Service categories retrieved successfully',
            'data' => $categories,
        ], 200);
    }

    // Create Service Category
    public function createServiceCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_link' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only(['name', 'title', 'description', 'button_link']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'service_categories');
        }

        $category = ServiceCategory::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Service category created successfully',
            'data' => $category,
        ], 201);
    }

    // Update Service Category
    public function updateServiceCategory(Request $request, $id)
    {
        $category = ServiceCategory::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_link' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $category->fill($request->only(['name', 'title', 'description', 'button_link']));

        if ($request->hasFile('image')) {
            $category->image = $this->imageUpload($request, 'image', 'service_categories', $category->image);
        }

        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Service category updated successfully',
            'data' => $category,
        ], 200);
    }

    // Delete Service Category
    public function deleteServiceCategory($id)
    {
        $category = ServiceCategory::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        if ($category->image) {
            \Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Service category deleted successfully',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceDetail;
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


    // Fetch All Service Details by Service Category
    public function getServiceDetailsByCategory($categoryId)
    {
        $serviceDetails = ServiceDetail::where('service_category_id', $categoryId)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Service details retrieved successfully',
            'data' => $serviceDetails,
        ], 200);
    }


    // Create or Update Service Details
    public function saveOrUpdateServiceDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_category_id' => 'required|exists:service_categories,id',
            'main_title' => 'required|string|max:255',
            'main_description' => 'nullable|string',
            'subtitle_one' => 'nullable|string|max:255',
            'subdescription_one' => 'nullable|string',
            'subtitle_two' => 'nullable|string|max:255',
            'subdescription_two' => 'nullable|string',
            'subtitle_three' => 'nullable|string|max:255',
            'subdescription_three' => 'nullable|string',
            'subtitle_four' => 'nullable|string|max:255',
            'subdescription_four' => 'nullable|string',
            'subtitle_five' => 'nullable|string|max:255',
            'subdescription_five' => 'nullable|string',
            'subtitle_six' => 'nullable|string|max:255',
            'subdescription_six' => 'nullable|string',
            'subtitle_seven' => 'nullable|string|max:255',
            'subdescription_seven' => 'nullable|string',
            'description' => 'nullable|string',
            'name' => 'nullable|string|max:255',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->except(['image_one', 'image_two', 'image_three']);

        $serviceDetail = ServiceDetail::updateOrCreate(
            ['service_category_id' => $request->service_category_id],
            $data
        );

        // Handle Image Upload Using HelperTrait
        if ($request->hasFile('image_one')) {
            $serviceDetail->image_one = $this->imageUpload($request, 'image_one', 'service_details', $serviceDetail->image_one);
        }
        if ($request->hasFile('image_two')) {
            $serviceDetail->image_two = $this->imageUpload($request, 'image_two', 'service_details', $serviceDetail->image_two);
        }
        if ($request->hasFile('image_three')) {
            $serviceDetail->image_three = $this->imageUpload($request, 'image_three', 'service_details', $serviceDetail->image_three);
        }

        $serviceDetail->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Service details saved/updated successfully',
            'data' => $serviceDetail,
        ], 200);
    }
}

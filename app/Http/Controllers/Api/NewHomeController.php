<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeBusinessUnit;
use App\Models\HomeService;
use App\Models\HomeAboutUs;
use App\Models\HomeExplore;
use App\Models\SliderFeatureInfo;
use App\Models\HomeVirtualTourCategory;
use App\Models\HomeVirtualTourSubcategory;
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
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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

    // Fetch All Home Services
    public function getAllServices()
    {
        $services = HomeService::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Services retrieved successfully',
            'data' => $services,
        ], 200);
    }

    // Create Home Service
    public function createService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('name', 'title', 'subtitle', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'home_services');
        }

        $service = HomeService::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Service created successfully',
            'data' => $service,
        ], 201);
    }

    // Update Home Service
    public function updateService(Request $request, $id)
    {
        $service = HomeService::find($id);

        if (!$service) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $service->fill($request->only('name', 'title', 'subtitle', 'description'));

        if ($request->hasFile('image')) {
            $service->image = $this->imageUpload($request, 'image', 'home_services');
        }

        $service->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Service updated successfully',
            'data' => $service,
        ], 200);
    }

    // Delete Home Service
    public function deleteService($id)
    {
        $service = HomeService::find($id);

        if (!$service) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service not found',
            ], 404);
        }

        if ($service->image) {
            \Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Service deleted successfully',
        ], 200);
    }

    // Fetch Home About Us Data
    public function getHomeAboutUs()
    {
        $aboutUs = HomeAboutUs::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Home About Us data retrieved successfully',
            'data' => $aboutUs,
        ], 200);
    }

    // Update Home About Us Data
    public function updateHomeAboutUs(Request $request)
    {
        $aboutUs = HomeAboutUs::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'description' => 'nullable|string',
            'youtube_link' => 'nullable|url',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'experience_count' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $aboutUs->fill($request->only([
            'name',
            'title',
            'subtitle',
            'meta_title',
            'meta_description',
            'description',
            'youtube_link',
            'link',
            'experience_count',
        ]));

        if ($request->hasFile('image')) {
            $aboutUs->image = $this->imageUpload($request, 'image', 'home_about_us');
        }

        $aboutUs->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Home About Us data updated successfully',
            'data' => $aboutUs,
        ], 200);
    }

    // Fetch Home Explore Data
    public function getHomeExplore()
    {
        $explore = HomeExplore::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Home Explore data retrieved successfully',
            'data' => $explore,
        ], 200);
    }

    // Update Home Explore Data
    public function updateHomeExplore(Request $request)
    {
        $explore = HomeExplore::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $explore->fill($request->only([
            'name',
            'title',
            'description',
        ]));

        if ($request->hasFile('image')) {
            $explore->image = $this->imageUpload($request, 'image', 'home_explore');
        }

        $explore->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Home Explore data updated successfully',
            'data' => $explore,
        ], 200);
    }

    // Fetch All Categories with Subcategories
    public function getAllCategories()
    {
        $categories = HomeVirtualTourCategory::with('subcategories')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Categories and subcategories retrieved successfully',
            'data' => $categories,
        ], 200);
    }

    // Create Category
    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('name');

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $this->imageUpload($request, 'background_image', 'virtual_tour_categories');
        }

        $category = HomeVirtualTourCategory::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    // Create Subcategory
    public function createSubcategory(Request $request, $categoryId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $category = HomeVirtualTourCategory::find($categoryId);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $data = $request->only('name');

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $this->imageUpload($request, 'background_image', 'virtual_tour_subcategories');
        }

        $subcategory = $category->subcategories()->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory created successfully',
            'data' => $subcategory,
        ], 201);
    }

    // Update Category
    public function updateCategory(Request $request, $id)
    {
        $category = HomeVirtualTourCategory::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $category->fill($request->only('name'));

        if ($request->hasFile('background_image')) {
            $category->background_image = $this->imageUpload($request, 'background_image', 'virtual_tour_categories');
        }

        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
            'data' => $category,
        ], 200);
    }

    // Delete Category
    public function deleteCategory($id)
    {
        $category = HomeVirtualTourCategory::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully',
        ], 200);
    }

    // Update Subcategory
    public function updateSubcategory(Request $request, $id)
    {
        $subcategory = HomeVirtualTourSubcategory::find($id);

        if (!$subcategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Subcategory not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $subcategory->fill($request->only('name'));

        if ($request->hasFile('background_image')) {
            $subcategory->background_image = $this->imageUpload($request, 'background_image', 'virtual_tour_subcategories');
        }

        $subcategory->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory updated successfully',
            'data' => $subcategory,
        ], 200);
    }

    // Delete Subcategory
    public function deleteSubcategory($id)
    {
        $subcategory = HomeVirtualTourSubcategory::find($id);

        if (!$subcategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Subcategory not found',
            ], 404);
        }

        if ($subcategory->background_image) {
            \Storage::disk('public')->delete($subcategory->background_image);
        }

        $subcategory->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory deleted successfully',
        ], 200);
    }

    // Fetch Slider Feature Info
    public function getSliderFeatureInfo()
    {
        $sliderInfo = SliderFeatureInfo::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Slider feature info retrieved successfully',
            'data' => $sliderInfo,
        ], 200);
    }

    // Update Slider Feature Info
    public function updateSliderFeatureInfo(Request $request)
    {
        $sliderInfo = SliderFeatureInfo::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $sliderInfo->fill($request->only([
            'title',
            'description',
        ]));

        if ($request->hasFile('image')) {
            $sliderInfo->image = $this->imageUpload($request, 'image', 'slider_feature_info');
        }

        $sliderInfo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Slider feature info updated successfully',
            'data' => $sliderInfo,
        ], 200);
    }
}

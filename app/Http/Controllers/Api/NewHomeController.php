<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeBusinessUnit;
use App\Models\HomeService;
use App\Models\HomeAboutUs;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
}

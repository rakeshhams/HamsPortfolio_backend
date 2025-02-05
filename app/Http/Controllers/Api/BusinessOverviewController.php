<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessHeroSection;
use App\Models\BusinessProductSection;
use App\Models\BusinessProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessOverviewController extends Controller {

    // Hero Section: Fetch
    public function getHeroSection() {
        $heroSection = BusinessHeroSection::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Hero section retrieved successfully',
            'data' => $heroSection
        ], 200);
    }

    // Hero Section: Update
    public function updateHeroSection(Request $request) {
        $heroSection = BusinessHeroSection::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Validation errors', 'errors' => $validator->errors()], 400);
        }

        $heroSection->fill($request->only('title', 'description'));

        if ($request->hasFile('hero_image')) {
            $heroSection->hero_image = $request->file('hero_image')->store('hero_images', 'public');
        }

        if ($request->hasFile('additional_image')) {
            $heroSection->additional_image = $request->file('additional_image')->store('hero_images', 'public');
        }

        $heroSection->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Hero section updated successfully',
            'data' => $heroSection
        ], 200);
    }

    // Dynamic Image Section Metadata: Fetch
    public function getDynamicImageSection() {
        $section = BusinessProductSection::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic image section metadata retrieved successfully',
            'data' => $section
        ], 200);
    }

    // Dynamic Image Section Metadata: Update
    public function updateDynamicImageSection(Request $request) {
        $section = BusinessProductSection::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'main_title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $section->fill($request->only('main_title', 'description'));
        $section->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic image section updated successfully',
            'data' => $section
        ], 200);
    }

    // Dynamic Images: Fetch
    public function getDynamicImages() {
        $dynamicImages = BusinessProductImages::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic images retrieved successfully',
            'data' => $dynamicImages
        ], 200);
    }

    // Dynamic Images: Create
    public function createDynamicImage(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $data = $request->only('title');
        $data['image'] = $request->file('image')->store('dynamic_images', 'public');

        $dynamicImage = BusinessProductImages::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic image created successfully',
            'data' => $dynamicImage
        ], 201);
    }

    // Dynamic Images: Delete
    public function deleteDynamicImage($id) {
        $dynamicImage = BusinessProductImages::find($id);

        if (!$dynamicImage) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found'
            ], 404);
        }

        $dynamicImage->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully'
        ], 200);
    }
}


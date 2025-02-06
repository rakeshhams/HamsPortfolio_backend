<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoingGreenHeroSection;
use App\Models\GreenEnvironmentalImpact;
use App\Models\GreenCommunity;
use App\Models\GreenInnovation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class GoingGreenController extends Controller
{
    use HelperTrait;
    // Fetch Going Green Hero Section
    public function getHeroSection()
    {
        $heroSection = GoingGreenHeroSection::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Going Green Hero Section retrieved successfully',
            'data' => $heroSection,
        ], 200);
    }

    // Update Going Green Hero Section
    public function updateHeroSection(Request $request)
    {
        $heroSection = GoingGreenHeroSection::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update fields
        $heroSection->fill($request->only('title', 'subtitle', 'description'));

        if ($request->hasFile('hero_image')) {
            $heroSection->hero_image = $this->imageUpload($request, 'hero_image', 'going_green');
        }

        $heroSection->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Going Green Hero Section updated successfully',
            'data' => $heroSection,
        ], 200);
    }
    // Fetch Green Environmental Impact Data
    public function getEnvironmentalImpact()
    {
        $environmentalImpact = GreenEnvironmentalImpact::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Environmental Impact data retrieved successfully',
            'data' => $environmentalImpact,
        ], 200);
    }

    // Update Green Environmental Impact Data
    public function updateEnvironmentalImpact(Request $request)
    {
        $environmentalImpact = GreenEnvironmentalImpact::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_description' => 'nullable|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update fields
        $environmentalImpact->fill($request->only('title', 'description', 'sub_description'));

        if ($request->hasFile('image_1')) {
            $environmentalImpact->image_1 = $this->imageUpload($request, 'image_1', 'environmental_impact');
        }
        if ($request->hasFile('image_2')) {
            $environmentalImpact->image_2 = $this->imageUpload($request, 'image_2', 'environmental_impact');
        }
        if ($request->hasFile('image_3')) {
            $environmentalImpact->image_3 = $this->imageUpload($request, 'image_3', 'environmental_impact');
        }
        if ($request->hasFile('image_4')) {
            $environmentalImpact->image_4 = $this->imageUpload($request, 'image_4', 'environmental_impact');
        }

        $environmentalImpact->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Environmental Impact updated successfully',
            'data' => $environmentalImpact,
        ], 200);
    }
    // Fetch Green Community Data
    public function getGreenCommunity()
    {
        $greenCommunity = GreenCommunity::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Community data retrieved successfully',
            'data' => $greenCommunity,
        ], 200);
    }

    // Update Green Community Data
    public function updateGreenCommunity(Request $request)
    {
        $greenCommunity = GreenCommunity::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update fields
        $greenCommunity->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $greenCommunity->image = $this->imageUpload($request, 'image', 'green_community');
        }

        $greenCommunity->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Community updated successfully',
            'data' => $greenCommunity,
        ], 200);
    }
    // Fetch Green Innovation Data
    public function getGreenInnovation()
    {
        $greenInnovation = GreenInnovation::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Innovation data retrieved successfully',
            'data' => $greenInnovation,
        ], 200);
    }

    // Update Green Innovation Data
    public function updateGreenInnovation(Request $request)
    {
        $greenInnovation = GreenInnovation::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update fields
        $greenInnovation->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $greenInnovation->image = $this->imageUpload($request, 'image', 'green_innovation');
        }

        $greenInnovation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Innovation updated successfully',
            'data' => $greenInnovation,
        ], 200);
    }

}

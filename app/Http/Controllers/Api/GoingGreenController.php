<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoingGreenHeroSection;
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

   
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessHeroSection;
use App\Models\BusinessProductSection;
use App\Models\BusinessProductImages;
use App\Models\BusinessMaterial;
use App\Models\BusinessKnittingUnit;
use App\Models\BusinessGarmentUnit;
use App\Models\BusinessSustainabilityUnit;
use App\Models\BusinessMultipleUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class BusinessOverviewController extends Controller
{
    use HelperTrait;

    // Hero Section: Fetch
    public function getHeroSection()
    {
        $heroSection = BusinessHeroSection::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Hero section retrieved successfully',
            'data' => $heroSection
        ], 200);
    }

    // Hero Section: Update
    public function updateHeroSection(Request $request)
    {
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
            $heroSection->hero_image = $this->imageUpload($request, 'hero_image', 'hero_images');
        }

        if ($request->hasFile('additional_image')) {
            $heroSection->additional_image = $this->imageUpload($request, 'additional_image', 'hero_images');
        }

        $heroSection->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Hero section updated successfully',
            'data' => $heroSection
        ], 200);
    }

    // Dynamic Image Section Metadata: Fetch
    public function getDynamicImageSection()
    {
        $section = BusinessProductSection::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic image section metadata retrieved successfully',
            'data' => $section
        ], 200);
    }

    // Dynamic Image Section Metadata: Update
    public function updateDynamicImageSection(Request $request)
    {
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
    public function getDynamicImages()
    {
        $dynamicImages = BusinessProductImages::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic images retrieved successfully',
            'data' => $dynamicImages
        ], 200);
    }

    // Dynamic Images: Create
    public function createDynamicImage(Request $request)
    {
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
        $data['image'] = $this->imageUpload($request, 'image', 'dynamic_images');

        $dynamicImage = BusinessProductImages::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic image created successfully',
            'data' => $dynamicImage
        ], 201);
    }
    // Dynamic Images: Update
    public function updateDynamicImage(Request $request, $id)
    {
        $dynamicImage = BusinessProductImages::find($id);

        if (!$dynamicImage) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $dynamicImage->title = $request->title;

        if ($request->hasFile('image')) {
            $dynamicImage->image = $this->imageUpload($request, 'image', 'dynamic_images');
        }

        $dynamicImage->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Dynamic image updated successfully',
            'data' => $dynamicImage
        ], 200);
    }

    // Dynamic Images: Delete
    public function deleteDynamicImage($id)
    {
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

    // Business Material: Fetch All
    public function getBusinessMaterials()
    {
        $materials = BusinessMaterial::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Business materials retrieved successfully',
            'data' => $materials
        ], 200);
    }

    // Business Material: Create
    public function createBusinessMaterial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $material = BusinessMaterial::create($request->only('title', 'description'));

        return response()->json([
            'status' => 'success',
            'message' => 'Business material created successfully',
            'data' => $material
        ], 201);
    }

    // Business Material: Update
    public function updateBusinessMaterial(Request $request, $id)
    {
        $material = BusinessMaterial::find($id);

        if (!$material) {
            return response()->json([
                'status' => 'error',
                'message' => 'Material not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $material->update($request->only('title', 'description'));

        return response()->json([
            'status' => 'success',
            'message' => 'Business material updated successfully',
            'data' => $material
        ], 200);
    }

    // Business Material: Delete
    public function deleteBusinessMaterial($id)
    {
        $material = BusinessMaterial::find($id);

        if (!$material) {
            return response()->json([
                'status' => 'error',
                'message' => 'Material not found'
            ], 404);
        }

        $material->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Business material deleted successfully'
        ], 200);
    }
    // Knitting Units: Fetch
    public function getKnittingUnit()
    {
        $knittingUnit = BusinessKnittingUnit::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Knitting unit retrieved successfully',
            'data' => $knittingUnit
        ], 200);
    }

    // Knitting Units: Update
    public function updateKnittingUnit(Request $request)
    {
        $knittingUnit = BusinessKnittingUnit::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $knittingUnit->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $knittingUnit->image = $this->imageUpload($request, 'image', 'knitting_units');
        }

        $knittingUnit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Knitting unit updated successfully',
            'data' => $knittingUnit
        ], 200);
    }
    // Garment Units: Fetch
    public function getGarmentUnit()
    {
        $garmentUnit = BusinessGarmentUnit::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Garment unit retrieved successfully',
            'data' => $garmentUnit
        ], 200);
    }

    // Garment Units: Update
    public function updateGarmentUnit(Request $request)
    {
        $garmentUnit = BusinessGarmentUnit::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $garmentUnit->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $garmentUnit->image = $this->imageUpload($request, 'image', 'garment_units');
        }

        $garmentUnit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Garment unit updated successfully',
            'data' => $garmentUnit
        ], 200);
    }
    // Sustainability Units: Fetch
    public function getSustainabilityUnit()
    {
        $sustainabilityUnit = BusinessSustainabilityUnit::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Sustainability unit retrieved successfully',
            'data' => $sustainabilityUnit
        ], 200);
    }

    // Sustainability Units: Update
    public function updateSustainabilityUnit(Request $request)
    {
        $sustainabilityUnit = BusinessSustainabilityUnit::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $sustainabilityUnit->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $sustainabilityUnit->image = $this->imageUpload($request, 'image', 'sustainability_units');
        }

        $sustainabilityUnit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Sustainability unit updated successfully',
            'data' => $sustainabilityUnit
        ], 200);
    }

    // Multiple Units: Fetch List
    public function getMultipleUnits()
    {
        $units = BusinessMultipleUnit::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Multiple units retrieved successfully',
            'data' => $units
        ], 200);
    }

    // Multiple Units: Create
    public function createMultipleUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $data = $request->only('title', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'multiple_units');
        }

        $unit = BusinessMultipleUnit::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Multiple unit created successfully',
            'data' => $unit
        ], 201);
    }

    // Multiple Units: Update
    public function updateMultipleUnit(Request $request, $id)
    {
        $unit = BusinessMultipleUnit::find($id);

        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $unit->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $unit->image = $this->imageUpload($request, 'image', 'multiple_units');
        }

        $unit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Multiple unit updated successfully',
            'data' => $unit
        ], 200);
    }

    // Multiple Units: Delete
    public function deleteMultipleUnit($id)
    {
        $unit = BusinessMultipleUnit::find($id);

        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit not found'
            ], 404);
        }

        $unit->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Multiple unit deleted successfully'
        ], 200);
    }



    /**
     * Helper method to upload images to storage
     * @param Request $request
     * @param string $field
     * @param string $path
     * @return string
     */

}

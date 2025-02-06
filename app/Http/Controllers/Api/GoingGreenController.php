<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoingGreenHeroSection;
use App\Models\GreenEnvironmentalImpact;
use App\Models\GreenCommunity;
use App\Models\GreenInnovation;
use App\Models\GreenConclusion;
use App\Models\GreenOurMessage;
use App\Models\GreenResponsibility;
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

    // Fetch Green Conclusion Data
    public function getGreenConclusion()
    {
        $greenConclusion = GreenConclusion::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Conclusion data retrieved successfully',
            'data' => $greenConclusion,
        ], 200);
    }

    // Update Green Conclusion Data
    public function updateGreenConclusion(Request $request)
    {
        $greenConclusion = GreenConclusion::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:5120', // Allow only PDF, max 5MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update fields
        $greenConclusion->fill($request->only('title', 'description'));

        if ($request->hasFile('file')) {
            $greenConclusion->file = $this->imageUpload($request, 'file', 'green_conclusion_pdfs');
        }

        $greenConclusion->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Conclusion updated successfully',
            'data' => $greenConclusion,
        ], 200);
    }

    // Fetch All Green Our Messages
    public function getAllGreenMessages()
    {
        $messages = GreenOurMessage::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Our Messages retrieved successfully',
            'data' => $messages,
        ], 200);
    }

    // Create Green Our Message
    public function createGreenMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $message = GreenOurMessage::create($request->only('title', 'description'));

        return response()->json([
            'status' => 'success',
            'message' => 'Green Our Message created successfully',
            'data' => $message,
        ], 201);
    }

    // Update Green Our Message
    public function updateGreenMessage(Request $request, $id)
    {
        $message = GreenOurMessage::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $message->update($request->only('title', 'description'));

        return response()->json([
            'status' => 'success',
            'message' => 'Green Our Message updated successfully',
            'data' => $message,
        ], 200);
    }

    // Delete Green Our Message
    public function deleteGreenMessage($id)
    {
        $message = GreenOurMessage::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message not found',
            ], 404);
        }

        $message->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Our Message deleted successfully',
        ], 200);
    }

    // Fetch All Green Responsibility Entries
    public function getAllGreenResponsibilities()
    {
        $responsibilities = GreenResponsibility::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Responsibility data retrieved successfully',
            'data' => $responsibilities,
        ], 200);
    }

    // Create Green Responsibility Entry
    public function createGreenResponsibility(Request $request)
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
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('title', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'green_responsibility');
        }

        $responsibility = GreenResponsibility::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Green Responsibility created successfully',
            'data' => $responsibility,
        ], 201);
    }

    // Update Green Responsibility Entry
    public function updateGreenResponsibility(Request $request, $id)
    {
        $responsibility = GreenResponsibility::find($id);

        if (!$responsibility) {
            return response()->json([
                'status' => 'error',
                'message' => 'Responsibility not found',
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
                'errors' => $validator->errors(),
            ], 400);
        }

        $responsibility->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $responsibility->image = $this->imageUpload($request, 'image', 'green_responsibility');
        }

        $responsibility->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Responsibility updated successfully',
            'data' => $responsibility,
        ], 200);
    }

    // Delete Green Responsibility Entry
    public function deleteGreenResponsibility($id)
    {
        $responsibility = GreenResponsibility::find($id);

        if (!$responsibility) {
            return response()->json([
                'status' => 'error',
                'message' => 'Responsibility not found',
            ], 404);
        }

        $responsibility->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Green Responsibility deleted successfully',
        ], 200);
    }

}

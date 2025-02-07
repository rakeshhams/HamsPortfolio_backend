<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUsMain;
use App\Models\AboutUsAccordion;
use App\Models\AboutDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class AboutUsController extends Controller
{
    use HelperTrait;

    // Fetch About Us Main Section
    public function getAboutUsMain()
    {
        $data = AboutUsMain::first();

        return response()->json([
            'status' => 'success',
            'message' => 'About Us main section retrieved successfully',
            'data' => $data,
        ], 200);
    }

    // Update About Us Main Section
    public function updateAboutUsMain(Request $request)
    {
        $data = AboutUsMain::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data->fill($request->only([
            'title',
            'subtitle',
            'description',
            'meta_title',
            'meta_description',
        ]));

        if ($request->hasFile('image_one')) {
            $data->image_one = $this->imageUpload($request, 'image_one', 'about_us');
        }

        if ($request->hasFile('image_two')) {
            $data->image_two = $this->imageUpload($request, 'image_two', 'about_us');
        }

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'About Us main section updated successfully',
            'data' => $data,
        ], 200);
    }


    // Fetch All Accordions
    public function getAllAccordions()
    {
        $accordions = AboutUsAccordion::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Accordions retrieved successfully',
            'data' => $accordions,
        ], 200);
    }

    // Create Accordion
    public function createAccordion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $accordion = AboutUsAccordion::create($request->only('title', 'description'));

        return response()->json([
            'status' => 'success',
            'message' => 'Accordion created successfully',
            'data' => $accordion,
        ], 201);
    }

    // Update Accordion
    public function updateAccordion(Request $request, $id)
    {
        $accordion = AboutUsAccordion::find($id);

        if (!$accordion) {
            return response()->json([
                'status' => 'error',
                'message' => 'Accordion not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $accordion->update($request->only('title', 'description'));

        return response()->json([
            'status' => 'success',
            'message' => 'Accordion updated successfully',
            'data' => $accordion,
        ], 200);
    }

    // Delete Accordion
    public function deleteAccordion($id)
    {
        $accordion = AboutUsAccordion::find($id);

        if (!$accordion) {
            return response()->json([
                'status' => 'error',
                'message' => 'Accordion not found',
            ], 404);
        }

        $accordion->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Accordion deleted successfully',
        ], 200);
    }

    // Fetch All Directors
    public function getAllDirectors()
    {
        $directors = AboutDirector::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Directors retrieved successfully',
            'data' => $directors,
        ], 200);
    }

    // Create Director
    public function createDirector(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('name', 'designation', 'facebook_link', 'linkedin_link', 'twitter_link');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'about_directors');
        }

        $director = AboutDirector::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Director created successfully',
            'data' => $director,
        ], 201);
    }

    // Update Director
    public function updateDirector(Request $request, $id)
    {
        $director = AboutDirector::find($id);

        if (!$director) {
            return response()->json([
                'status' => 'error',
                'message' => 'Director not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $director->fill($request->only('name', 'designation', 'facebook_link', 'linkedin_link', 'twitter_link'));

        if ($request->hasFile('image')) {
            $director->image = $this->imageUpload($request, 'image', 'about_directors');
        }

        $director->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Director updated successfully',
            'data' => $director,
        ], 200);
    }

    // Delete Director
    public function deleteDirector($id)
    {
        $director = AboutDirector::find($id);

        if (!$director) {
            return response()->json([
                'status' => 'error',
                'message' => 'Director not found',
            ], 404);
        }

        if ($director->image) {
            \Storage::disk('public')->delete($director->image);
        }

        $director->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Director deleted successfully',
        ], 200);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessOverviewController extends Controller {
    
    // Fetch all sections (Admin & Client)
    public function index(Request $request) {
        $query = BusinessDetail::query();

        // Optional: Filter by section
        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Business details retrieved successfully',
            'data' => $query->get()
        ], 200);
    }

    // Fetch a single section by ID
    public function show($id) {
        $section = BusinessDetail::find($id);
        if (!$section) {
            return response()->json([
                'status' => 'error',
                'message' => 'Section not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Section retrieved successfully',
            'data' => $section
        ], 200);
    }

    // Store new section (Admin Only)
    public function store(Request $request) {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'section' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $data = $request->only('section', 'title', 'content');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('business_images', 'public');
        }

        $section = BusinessDetail::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Business section created successfully',
            'data' => $section
        ], 201);
    }

    // Update a section (Admin Only)
    public function update(Request $request, $id) {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null
            ], 403);
        }

        $section = BusinessDetail::find($id);
        if (!$section) {
            return response()->json([
                'status' => 'error',
                'message' => 'Section not found',
                'data' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $section->update($request->only('title', 'content'));

        if ($request->hasFile('image')) {
            $section->image = $request->file('image')->store('business_images', 'public');
            $section->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Business section updated successfully',
            'data' => $section
        ], 200);
    }

    // Delete a section (Admin Only)
    public function destroy($id) {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null
            ], 403);
        }

        $section = BusinessDetail::find($id);
        if (!$section) {
            return response()->json([
                'status' => 'error',
                'message' => 'Section not found',
                'data' => null
            ], 404);
        }

        $section->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Business section deleted successfully',
            'data' => null
        ], 200);
    }
}

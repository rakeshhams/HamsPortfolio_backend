<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplianceCommonInformation;
use App\Models\ComplianceMilestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class ComplianceController extends Controller
{
    use HelperTrait;

    // Fetch Compliance Common Information
    public function getComplianceInfo()
    {
        $complianceInfo = ComplianceCommonInformation::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Compliance Common Information retrieved successfully',
            'data' => $complianceInfo,
        ], 200);
    }

    // Update Compliance Common Information
    public function updateComplianceInfo(Request $request)
    {
        $complianceInfo = ComplianceCommonInformation::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update fields
        $complianceInfo->fill($request->only('title', 'description'));

        if ($request->hasFile('hero_image')) {
            $complianceInfo->hero_image = $this->imageUpload($request, 'hero_image', 'compliance_common');
        }

        $complianceInfo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Compliance Common Information updated successfully',
            'data' => $complianceInfo,
        ], 200);
    }

    // Fetch All Compliance Milestones
    public function getAllComplianceMilestones()
    {
        $milestones = ComplianceMilestone::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Compliance Milestones retrieved successfully',
            'data' => $milestones,
        ], 200);
    }

    // Create Compliance Milestone
    public function createComplianceMilestone(Request $request)
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
            $data['image'] = $this->imageUpload($request, 'image', 'compliance_milestones');
        }

        $milestone = ComplianceMilestone::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Compliance Milestone created successfully',
            'data' => $milestone,
        ], 201);
    }

    // Update Compliance Milestone
    public function updateComplianceMilestone(Request $request, $id)
    {
        $milestone = ComplianceMilestone::find($id);

        if (!$milestone) {
            return response()->json([
                'status' => 'error',
                'message' => 'Milestone not found',
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

        $milestone->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $milestone->image = $this->imageUpload($request, 'image', 'compliance_milestones');
        }

        $milestone->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Compliance Milestone updated successfully',
            'data' => $milestone,
        ], 200);
    }

    // Delete Compliance Milestone
    public function deleteComplianceMilestone($id)
    {
        $milestone = ComplianceMilestone::find($id);

        if (!$milestone) {
            return response()->json([
                'status' => 'error',
                'message' => 'Milestone not found',
            ], 404);
        }

        $milestone->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Compliance Milestone deleted successfully',
        ], 200);
    }


}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplianceCommonInformation;
use App\Models\ComplianceMilestone;
use App\Models\ComplianceActivity;
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


     // Fetch All Compliance Activities
     public function getAllComplianceActivities()
     {
         $activities = ComplianceActivity::all();
 
         return response()->json([
             'status' => 'success',
             'message' => 'Compliance Activities retrieved successfully',
             'data' => $activities,
         ], 200);
     }
 
     // Create Compliance Activity
     public function createComplianceActivity(Request $request)
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
             $data['image'] = $this->imageUpload($request, 'image', 'compliance_activities');
         }
 
         $activity = ComplianceActivity::create($data);
 
         return response()->json([
             'status' => 'success',
             'message' => 'Compliance Activity created successfully',
             'data' => $activity,
         ], 201);
     }
 
     // Update Compliance Activity
     public function updateComplianceActivity(Request $request, $id)
     {
         $activity = ComplianceActivity::find($id);
 
         if (!$activity) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Activity not found',
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
 
         $activity->fill($request->only('title', 'description'));
 
         if ($request->hasFile('image')) {
             $activity->image = $this->imageUpload($request, 'image', 'compliance_activities');
         }
 
         $activity->save();
 
         return response()->json([
             'status' => 'success',
             'message' => 'Compliance Activity updated successfully',
             'data' => $activity,
         ], 200);
     }
 
     // Delete Compliance Activity
     public function deleteComplianceActivity($id)
     {
         $activity = ComplianceActivity::find($id);
 
         if (!$activity) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Activity not found',
             ], 404);
         }
 
         $activity->delete();
 
         return response()->json([
             'status' => 'success',
             'message' => 'Compliance Activity deleted successfully',
         ], 200);
     }


}

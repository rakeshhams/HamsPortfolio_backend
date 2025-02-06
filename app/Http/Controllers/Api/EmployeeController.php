<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeCommonInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class EmployeeController extends Controller
{
    use HelperTrait;

    // Fetch Employee Common Information
    public function getEmployeeCommonInfo()
    {
        $employeeInfo = EmployeeCommonInfo::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee Common Information retrieved successfully',
            'data' => $employeeInfo,
        ], 200);
    }

    // Update Employee Common Information
    public function updateEmployeeCommonInfo(Request $request)
    {
        $employeeInfo = EmployeeCommonInfo::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
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
        $employeeInfo->fill($request->only('title', 'description_one', 'description_two'));

        if ($request->hasFile('hero_image')) {
            $employeeInfo->hero_image = $this->imageUpload($request, 'hero_image', 'employee_common_info');
        }

        $employeeInfo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee Common Information updated successfully',
            'data' => $employeeInfo,
        ], 200);
    }

    
}

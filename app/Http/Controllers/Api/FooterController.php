<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;

class FooterController extends Controller
{
    use HelperTrait;

    // Fetch All Footer Companies
    public function getAllCompanies()
    {
        $companies = FooterCompany::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Footer companies retrieved successfully',
            'data' => $companies,
        ], 200);
    }

    // Create Footer Company
    public function createCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('name', 'link');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'footer_companies');
        }

        $company = FooterCompany::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Footer company created successfully',
            'data' => $company,
        ], 201);
    }

    // Update Footer Company
    public function updateCompany(Request $request, $id)
    {
        $company = FooterCompany::find($id);

        if (!$company) {
            return response()->json([
                'status' => 'error',
                'message' => 'Company not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $company->fill($request->only('name', 'link'));

        if ($request->hasFile('image')) {
            $company->image = $this->imageUpload($request, 'image', 'footer_companies');
        }

        $company->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Footer company updated successfully',
            'data' => $company,
        ], 200);
    }

    // Delete Footer Company
    public function deleteCompany($id)
    {
        $company = FooterCompany::find($id);

        if (!$company) {
            return response()->json([
                'status' => 'error',
                'message' => 'Company not found',
            ], 404);
        }

        if ($company->image) {
            \Storage::disk('public')->delete($company->image);
        }

        $company->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Footer company deleted successfully',
        ], 200);
    }

   
}

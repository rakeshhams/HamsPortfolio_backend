<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterCompany;
use App\Models\FooterInformation;
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

    // Fetch Footer Information
    public function getFooterInformation()
    {
        $footerInfo = FooterInformation::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Footer information retrieved successfully',
            'data' => $footerInfo,
        ], 200);
    }

    // Update Footer Information
    public function updateFooterInformation(Request $request)
    {
        $footerInfo = FooterInformation::firstOrCreate([]);

        $validator = Validator::make($request->all(), [
            'address' => 'nullable|string',
            'factory_address' => 'nullable|string',
            'gmail' => 'nullable|email',
            'social_link_one' => 'nullable|url',
            'social_link_two' => 'nullable|url',
            'social_link_three' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $footerInfo->fill($request->only([
            'address',
            'factory_address',
            'gmail',
            'social_link_one',
            'social_link_two',
            'social_link_three',
        ]));

        $footerInfo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Footer information updated successfully',
            'data' => $footerInfo,
        ], 200);
    }
   
}

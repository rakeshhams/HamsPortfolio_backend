<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoryRecentPost;
use App\Models\StoryFeaturePost;
use App\Models\StoryVideo;
use App\Models\StoryCategory;
use App\Models\StoryCategoryImage;
use App\Models\StoryCommonInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;
class StoriesController extends Controller
{
    use HelperTrait;
    // Fetch All Story Recent Posts
    public function getAllStoryRecentPosts()
    {
        $stories = StoryRecentPost::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Recent Posts retrieved successfully',
            'data' => $stories,
        ], 200);
    }

    // Create Story Recent Post
    public function createStoryRecentPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'post_date' => 'nullable|date_format:Y-m-d', // Accepts YYYY-MM-DD format
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('title', 'description', 'link', 'post_date');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request, 'image', 'story_recent_posts');
        }

        $story = StoryRecentPost::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Story Recent Post created successfully',
            'data' => $story,
        ], 201);
    }

    // Update Story Recent Post
    public function updateStoryRecentPost(Request $request, $id)
    {
        $story = StoryRecentPost::find($id);

        if (!$story) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'post_date' => 'nullable|date_format:Y-m-d', // Ensures correct date format
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $story->fill($request->only('title', 'description', 'link', 'post_date'));

        if ($request->hasFile('image')) {
            $story->image = $this->imageUpload($request, 'image', 'story_recent_posts');
        }

        $story->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Recent Post updated successfully',
            'data' => $story,
        ], 200);
    }

    // Delete Story Recent Post
    public function deleteStoryRecentPost($id)
    {
        $story = StoryRecentPost::find($id);

        if (!$story) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found',
            ], 404);
        }

        $story->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Recent Post deleted successfully',
        ], 200);
    }

    // Fetch All Story Feature Posts
    public function getAllStoryFeaturePosts()
    {
        $stories = StoryFeaturePost::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Feature Posts retrieved successfully',
            'data' => $stories,
        ], 200);
    }

    // Create Story Feature Post
    public function createStoryFeaturePost(Request $request)
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
            $data['image'] = $this->imageUpload($request, 'image', 'story_feature_posts');
        }

        $story = StoryFeaturePost::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Story Feature Post created successfully',
            'data' => $story,
        ], 201);
    }

    // Update Story Feature Post
    public function updateStoryFeaturePost(Request $request, $id)
    {
        $story = StoryFeaturePost::find($id);

        if (!$story) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found',
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

        $story->fill($request->only('title', 'description'));

        if ($request->hasFile('image')) {
            $story->image = $this->imageUpload($request, 'image', 'story_feature_posts');
        }

        $story->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Feature Post updated successfully',
            'data' => $story,
        ], 200);
    }

    // Delete Story Feature Post
    public function deleteStoryFeaturePost($id)
    {
        $story = StoryFeaturePost::find($id);

        if (!$story) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found',
            ], 404);
        }

        $story->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Feature Post deleted successfully',
        ], 200);
    }

    // Fetch All Story Videos
    public function getAllStoryVideos()
    {
        $videos = StoryVideo::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Videos retrieved successfully',
            'data' => $videos,
        ], 200);
    }

    // Create Story Video
    public function createStoryVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = $request->only('title', 'link');

        $video = StoryVideo::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Story Video created successfully',
            'data' => $video,
        ], 201);
    }

    // Update Story Video
    public function updateStoryVideo(Request $request, $id)
    {
        $video = StoryVideo::find($id);

        if (!$video) {
            return response()->json([
                'status' => 'error',
                'message' => 'Video not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $video->fill($request->only('title', 'link'));
        $video->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Video updated successfully',
            'data' => $video,
        ], 200);
    }

    // Delete Story Video
    public function deleteStoryVideo($id)
    {
        $video = StoryVideo::find($id);

        if (!$video) {
            return response()->json([
                'status' => 'error',
                'message' => 'Video not found',
            ], 404);
        }

        $video->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Video deleted successfully',
        ], 200);
    }


    // Fetch All Story Categories
    public function getAllStoryCategories()
    {
        $categories = StoryCategory::with('images')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Categories retrieved successfully',
            'data' => $categories,
        ], 200);
    }

    // Create Story Category
    public function createStoryCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $category = StoryCategory::create($request->only('name'));

        return response()->json([
            'status' => 'success',
            'message' => 'Story Category created successfully',
            'data' => $category,
        ], 201);
    }

    // Update Story Category
    public function updateStoryCategory(Request $request, $id)
    {
        $category = StoryCategory::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $category->update($request->only('name'));

        return response()->json([
            'status' => 'success',
            'message' => 'Story Category updated successfully',
            'data' => $category,
        ], 200);
    }

    // Delete Story Category
    public function deleteStoryCategory($id)
    {
        $category = StoryCategory::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Category deleted successfully',
        ], 200);
    }

    // Add Image to Story Category
    public function addImageToStoryCategory(Request $request, $categoryId)
    {
        // Check if the category exists
        $category = StoryCategory::find($categoryId);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Use the imageUpload helper to handle the file upload
        if ($request->hasFile('image')) {
            $imagePath = $this->imageUpload($request, 'image', 'story_category_images');

            // Explicitly create the record using the StoryCategoryImage model
            $image = StoryCategoryImage::create([
                'story_category_id' => $categoryId,
                'image' => $imagePath,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Image added to category successfully',
                'data' => $image,
            ], 201);
        }

        // Fallback in case the image is not uploaded
        return response()->json([
            'status' => 'error',
            'message' => 'Image upload failed',
        ], 500);
    }

    // Update an Image in Story Category
    public function updateStoryCategoryImage(Request $request, $imageId)
    {
        // Find the image by ID
        $image = StoryCategoryImage::find($imageId);

        if (!$image) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found',
            ], 404);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Delete the old image from storage
        if ($image->image) {
            \Storage::disk('public')->delete($image->image);
        }

        // Upload the new image using the helper
        $newImagePath = $this->imageUpload($request, 'image', 'story_category_images');

        // Update the image path in the database
        $image->update(['image' => $newImagePath]);

        return response()->json([
            'status' => 'success',
            'message' => 'Image updated successfully',
            'data' => $image,
        ], 200);
    }
    // Delete an Image in Story Category
    public function deleteStoryCategoryImage($imageId)
    {
        // Find the image by ID
        $image = StoryCategoryImage::find($imageId);

        if (!$image) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found',
            ], 404);
        }

        // Delete the image file from storage
        if ($image->image) {
            \Storage::disk('public')->delete($image->image);
        }

        // Delete the record from the database
        $image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully',
        ], 200);
    }
    // Fetch Story Common Info
    public function getStoryCommonInfo()
    {
        $info = StoryCommonInfo::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Common Info retrieved successfully',
            'data' => $info,
        ], 200);
    }

    // Update Story Common Info
    public function updateStoryCommonInfo(Request $request)
    {
        // Retrieve the first (or create if it doesn't exist)
        $info = StoryCommonInfo::firstOrCreate([]);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Update the fields
        $info->fill($request->only('meta_title', 'meta_description'));

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            $info->hero_image = $this->imageUpload($request, 'hero_image', 'story_common_info');
        }

        $info->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Story Common Info updated successfully',
            'data' => $info,
        ], 200);
    }

}

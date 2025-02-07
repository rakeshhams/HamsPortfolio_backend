<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoryRecentPost;
use App\Models\StoryFeaturePost;
use App\Models\StoryVideo;
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
}

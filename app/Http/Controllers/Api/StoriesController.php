<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoryRecentPost;
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

   
}

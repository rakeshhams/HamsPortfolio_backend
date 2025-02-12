<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientMessageController extends Controller
{
    // Fetch All Client Messages (For Admin)
    public function getAllMessages()
    {
        $messages = ClientMessage::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Client messages retrieved successfully',
            'data' => $messages,
        ], 200);
    }

    // Store a New Client Message (For Client)
    public function storeClientMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        $message = ClientMessage::create($request->only('name', 'email', 'message'));

        return response()->json([
            'status' => 'success',
            'message' => 'Your message has been sent successfully',
            'data' => $message,
        ], 201);
    }

    // Delete a Client Message (For Admin)
    public function deleteClientMessage($id)
    {
        $message = ClientMessage::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message not found',
            ], 404);
        }

        $message->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Message deleted successfully',
        ], 200);
    }
}

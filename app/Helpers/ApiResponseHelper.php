<?php

namespace App\Helpers;

class ApiResponseHelper
{
    public static function success($data = [], $message = 'Request was successful', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function error($message = 'An error occurred', $statusCode = 400, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    public static function validationError($errors, $message = 'Validation failed', $statusCode = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    // New method for handling successful creation
    public static function created($data = [], $message = 'Resource created successfully', $statusCode = 201)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    // New method for handling successful update
    public static function updated($data = [], $message = 'Resource updated successfully', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    // New method for handling successful deletion
    public static function deleted($message = 'Resource deleted successfully', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], $statusCode);
    }

    // New method for handling successful upload
    public static function uploaded($data = [], $message = 'File uploaded successfully', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    // New method for handling errors during file upload
    public static function uploadError($message = 'File upload failed', $statusCode = 500, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    // New method for handling general errors
    public static function generalError($message = 'An unexpected error occurred', $statusCode = 500, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}

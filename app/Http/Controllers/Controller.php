<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // contoh penggunaaan respond api
    public function someFunction()
    {
        try {
            // Some code logic
            $data = []; // Replace with actual data
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function someValidationFunction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'field_name' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::validationError($validator->errors());
        }

        // Further processing
        return ApiResponseHelper::success([], 'Validation passed');
    }
}

<?php

namespace App\Traits;

trait ApiResponse
{
    public function success(array|object $data = [], int $status = 200, string $message = ''): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => true,
        ];
        if (!empty($data))
            $response['data'] = $data;

        if (!empty($message))
            $response['message'] = $message;

        return response()->json($response, $status);
    }

    public function error(string $message = '', int $status = 400, array|object $errors = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
        ];
        if (!empty($errors))
            $response['errors'] = $errors;

        if (!empty($message))
            $response['message'] = $message;

        return response()->json($response, $status);
    }
}

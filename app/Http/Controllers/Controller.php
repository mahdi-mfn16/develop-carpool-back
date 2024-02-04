<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="Carpool Api", version="0.1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function successJsonResponse($data = [], $message = 'successful', $code = 200)
    {
        return response()->json([
            'data' => ['item' => $data],
            'message' => $message,
            'status' => $code
        ]);
    }

    public function successArrayResponse($data = [], $message = 'successful', $code = 200)
    {
        return response()->json([
            'data' => ['items' => $data],
            'message' => $message,
            'status' => $code
        ]);
    }


    public function errorResponse($data = [], $message = 'error', $code = 400)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $code
        ]);
    }
}

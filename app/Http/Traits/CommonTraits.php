<?php

namespace App\Http\Traits;

/**
 * Collection of reuseable methods
 */
trait CommonTraits
{
    
    private function response($data = null, $responseCode = 200, $errors = null)
    {

        $response = [
            'success' => $responseCode == 200 ? true : false,
            'errors' => $errors,
            'data' => $data
        ];

        return response()->json($response, $responseCode);

    }

}

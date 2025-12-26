<?php

namespace App\Traits;

trait ResponseTrait
{
    public function showResponse($input = [], $code = 200) {
        $response = [
            'success' => true,
            'message' => __('messages.public.success'),
            'data' => $input,
        ];

        if (isset($input['success'], $input['message'], $input['data'])) {
            $response = $input;
        }

        return response($response, $code);
    }
}

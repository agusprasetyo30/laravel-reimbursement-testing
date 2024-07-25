<?php

namespace App\Traits;

/**
 * use to return response data
 */
trait MainResponseTrait
{
    public function success($data = [], $message = "Succes !")
    {
        return response()
            ->json([
                'error'   => 0,
                'message' => $message,
                'data'    => $data
            ]);
    }

    public function successArray($data = [], $message = "Succes !")
    {
        return [
            'error' => 0,
            'message' => $message,
            'data' => $data
        ];
    }

    public function error($message = "Something when wrong", $code = null, $data = [])
    {
        return response()
            ->json([
                'error'   => 1,
                'message' => $message,
                'data'    => $data,
                'code'    => $code,
            ]);
    }

    public function errorArray($message = "Something when wrong", $code = null, $data = [])
    {
        return [
            'error' => 1,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }
}

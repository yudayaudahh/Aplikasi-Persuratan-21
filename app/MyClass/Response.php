<?php

namespace App\MyClass;

class Response
{
    public static function success($array = [])
    {
        if (!array_key_exists('message', $array)) {
            $array['message'] = 'Berhasil';
        }

        return response()->json(array_merge($array, [
            'code'        => 200,
        ]));
    }
}

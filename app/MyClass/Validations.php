<?php

namespace App\MyClass;

use Carbon\Carbon;

class Validations
{
    public static function loginValidate($request)
    {
        $request->validate([
            'nip' => 'required|exists:users,nip',
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nip.exists' => 'NIP tidak ditemukan',
        ]);
    }
}

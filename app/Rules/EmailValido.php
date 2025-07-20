<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmailValido implements Rule
{
    public function passes($attribute, $value)
    {
        try {
            $result = DB::selectOne('SELECT validar_correo_electronico(?) AS valido', [$value]);
            return $result && isset($result->valido) && $result->valido === true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function message()
    {
        return 'El :attribute no es válido según la validación personalizada.';
    }
}

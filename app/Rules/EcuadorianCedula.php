<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EcuadorianCedula implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Ejecutar la función SQL validar_cedula_ecuatoriana
        $result = DB::selectOne('SELECT validar_cedula_ecuatoriana(?) AS es_valida', [$value]);

        return $result->es_valida;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La :attribute no es una cédula ecuatoriana válida.';
    }
}
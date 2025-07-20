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
        try {
            $result = DB::selectOne('SELECT validar_cedula_ecuatoriana(?) AS es_valida', [$value]);

            return $result && isset($result->es_valida) && $result->es_valida === true;
        } catch (\Exception $e) {
            // Opcional: puedes registrar el error si lo deseas
            // Log::error('Error validando cédula: ' . $e->getMessage());
            return false;
        }
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

<?php

namespace App\Helpers;

class ValidationHelper
{
    public static function validarCampo($tipo, $valor)
    {
        switch ($tipo) {
            case "correo":
                if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
                    return "El correo electrónico no es válido.";
                }
                break;
            case "contrasena":
                // Validar la contraseña
                // Mínimo de longitud
                if (strlen($valor) < 8) {
                    return "La contraseña debe tener al menos 8 caracteres.";
                }
                break;
            
            default:
                return "Tipo de validación no soportado.";
        }

        // Si pasó todas las validaciones, devuelve verdadero
        return true;
    }
}
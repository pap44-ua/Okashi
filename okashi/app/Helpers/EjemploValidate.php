<?php

use App\Helpers\ValidationHelper;

// Ejemplo de uso:
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Validar campos
$errores = [];
$errores[] = ValidationHelper::validarCampo('correo', $correo);
$errores[] = ValidationHelper::validarCampo('contrasena', $contrasena);

// Verificar si hay errores
foreach ($errores as $error) {
    if ($error !== true) {
        echo $error . "<br>";
    }
}

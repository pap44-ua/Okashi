# Okashi

## Okashi es una tienda de dulces japoneses desarrollada con php, laravel, blade y boostrap.

Antes de empezar sustituir en el .env esto por el que sale por defecto, esto hara que el correo funcione


MAIL_DRIVER=smtp

MAIL_HOST=smtp.gmail.com

MAIL_PORT=587

MAIL_USERNAME=okashistore23@gmail.com

MAIL_PASSWORD=avsannsfawkyyztm

MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS=okashistore23@gmail.com

MAIL_FROM_NAME="${APP_NAME}"

 
Si las imagenes no se ven ejecuta: `php artisan storage:link` para crear un enlace entre `storage/app/public` y `public/storage`

Para el paquete de traducción ejecutar:

    composer require mcamara/laravel-localization
    php artisan vendor:publish --provider="Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider"

Si da este error:

    Class "Laravel\Socialite\SocialiteServiceProvider" not found
    Solucion: composer install

Si la pagina web se ve rara puede ser que no este instalado boostrap:

    npm install

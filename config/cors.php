<?php

return [

'paths' => ['api/*', 'sanctum/csrf-cookie'],

'allowed_methods' => ['*'], // Permitir todos los métodos

'allowed_origins' => ['http://localhost:4200' , 'https://0f8ced1f.opticazhufront-ej7.pages.dev/login'], // Aquí va el origen de tu frontend

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'], // Permitir todos los headers

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => false,

];

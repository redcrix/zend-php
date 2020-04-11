<?php
return [
    'zfr_cors' => [        
        'allowed_origins' => ['http://localhost:4200', 'https://app.useful.com.br'],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'],
        // Insira os cabeçalhos permitidos nas requisições conforme abaixo
        'allowed_headers' => ['Authorization', 'Content-Type', 'Access-Control-Allow-Origin', 'Lang'],        
        'max_age' => 120,
        'exposed_headers' => [],
        'allowed_credentials' => false,
    ],
];
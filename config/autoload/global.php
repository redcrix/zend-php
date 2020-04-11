<?php

return [
    'frontend' => [
        'uri' => 'http://localhost:4200',
    ],
    'api-externo' => 'http://inetpet',
    'stripe-session' => 'https://api.stripe.com/v1/checkout/sessions',
    'inetpet-checkout-sucess' => 'https://inetpet.useful.com.br/checkout/success',
    'inetpet-checkout-cancel' => 'https://inetpet.useful.com.br/checkout/cancel',
    'stripe' => 'sk_test_G6MZYEhsn0mRx9OGLLI6tHY200uV8PARNY',
    'stripe-folder' => __DIR__.'/../../data/stripe/',
    'inetpet-image' => 'https://inetpet.useful.com.br/images/product.png',
    'sendgrid-api' => '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',
    'zf-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [],
    ],
    'zf-oauth2' => [
        'allow_implicit' => true,
        'access_lifetime' => 43200,
        'enforce_state' => true,
        'options' => [
            'use_jwt_access_tokens' => true,
            'store_encrypted_token_string' => true,
            'use_openid_connect' => true,
            'issuer' => 'inetpet',
            'id_lifetime' => 43200,
            'www_realm' => 'Service',
            'token_param_name' => 'access_token',
            'token_bearer_header_name' => 'Bearer',
            'require_exact_redirect_uri' => true,
            'allow_credentials_in_request_body' => true,
            'allow_public_clients' => true,
            'always_issue_new_refresh_token' => true,
            'unset_refresh_token_after_use' => true,
        ],
    ],
    'router' => [
        'routes' => [
            'oauth' => [
                'options' => [
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ],
                'type' => 'regex',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'map' => [
                'API\\V1' => 'oauth2',
            ],
        ],
    ],
];

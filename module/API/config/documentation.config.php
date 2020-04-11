<?php
return [
    'API\\V1\\Rpc\\LoginClient\\Controller' => [
        'GET' => [
            'response' => '',
        ],
        'POST' => [
            'request' => '{
   "username": "Nome do usuário",
   "password": "Senha do usuário"
}',
            'response' => '{
   "token": "token-do-usuario",
   "last-login": "12/12/2020",
   "user": {...}
}',
            'description' => 'Autentica um usuário client',
        ],
        'description' => 'RPC responsável pela autenticação de clientes ao App',
    ],
    'API\\V1\\Rpc\\PasswordChange\\Controller' => [
        'description' => 'Serviço para mudança de senha.',
        'POST' => [
            'description' => 'Serviço para mudança de senha.',
            'request' => '{
   "password": "Nova senha",
   "old": "Senha antiga para validação"
}',
            'response' => '{
   "changed": true,
   "status": "ok"
}',
        ],
    ],
    'API\\V1\\Rest\\Distributor\\Controller' => [
        'description' => 'REST dedicado ao distribuidor',
        'collection' => [
            'GET' => [
                'response' => '{
   "_links": {
       "self": {
           "href": "/distributor"
       },
       "first": {
           "href": "/distributor?page={page}"
       },
       "prev": {
           "href": "/distributor?page={page}"
       },
       "next": {
           "href": "/distributor?page={page}"
       },
       "last": {
           "href": "/distributor?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/distributor[/:distributor_id]"
                   }
               }
              "user": "Dados de usuário do distribuidor.",
              "clinics": "Clínicas do distribuidor"
           }
       ]
   }
}',
                'description' => 'Recupera lista de distribuidores',
            ],
            'POST' => [
                'description' => 'Atualiza um distribuidor',
                'request' => '{
   "user": "Dados de usuário do distribuidor.",
   "clinics": "Clínicas do distribuidor"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/distributor[/:distributor_id]"
       }
   }
   "user": "Dados de usuário do distribuidor.",
   "clinics": "Clínicas do distribuidor"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Recupera um distribuidor',
                'response' => '{
   "_links": {
       "self": {
           "href": "/distributor[/:distributor_id]"
       }
   }
   "user": "Dados de usuário do distribuidor.",
   "clinics": "Clínicas do distribuidor"
}',
            ],
            'DELETE' => [
                'description' => 'Remove um distribuidor',
                'request' => '{
   "user": "Dados de usuário do distribuidor.",
   "clinics": "Clínicas do distribuidor"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/distributor[/:distributor_id]"
       }
   }
   "user": "Dados de usuário do distribuidor.",
   "clinics": "Clínicas do distribuidor"
}',
            ],
        ],
    ],
    'API\\V1\\Rest\\User\\Controller' => [
        'description' => 'REST para manter um usuário',
        'collection' => [
            'GET' => [
                'description' => 'Recupera uma lista de usuários',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user"
       },
       "first": {
           "href": "/user?page={page}"
       },
       "prev": {
           "href": "/user?page={page}"
       },
       "next": {
           "href": "/user?page={page}"
       },
       "last": {
           "href": "/user?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/user[/:user_id]"
                   }
               }
              "username": "Nome de usuário",
              "name": "Nome do usuário",
              "document": "Documento fiscal do usuário",
              "phone": "Telefone do usuário",
              "photo": "Foto do usuário",
              "address": "Endereço do usuário"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Persiste um usuário',
                'request' => '{
   "username": "Nome de usuário",
   "name": "Nome do usuário",
   "document": "Documento fiscal do usuário",
   "phone": "Telefone do usuário",
   "photo": "Foto do usuário",
   "address": "Endereço do usuário"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user[/:user_id]"
       }
   }
   "username": "Nome de usuário",
   "name": "Nome do usuário",
   "document": "Documento fiscal do usuário",
   "phone": "Telefone do usuário",
   "photo": "Foto do usuário",
   "address": "Endereço do usuário"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Recupera um usuário',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user[/:user_id]"
       }
   }
   "username": "Nome de usuário",
   "name": "Nome do usuário",
   "document": "Documento fiscal do usuário",
   "phone": "Telefone do usuário",
   "photo": "Foto do usuário",
   "address": "Endereço do usuário"
}',
            ],
            'DELETE' => [
                'description' => 'Remove um usuário',
                'request' => '{
   "username": "Nome de usuário",
   "name": "Nome do usuário",
   "document": "Documento fiscal do usuário",
   "phone": "Telefone do usuário",
   "photo": "Foto do usuário",
   "address": "Endereço do usuário"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user[/:user_id]"
       }
   }
   "username": "Nome de usuário",
   "name": "Nome do usuário",
   "document": "Documento fiscal do usuário",
   "phone": "Telefone do usuário",
   "photo": "Foto do usuário",
   "address": "Endereço do usuário"
}',
            ],
        ],
    ],
    'API\\V1\\Rest\\Clinic\\Controller' => [
        'description' => 'REST para manter clínicas',
        'collection' => [
            'GET' => [
                'description' => 'Recupera lista de clínicas',
                'response' => '{
   "_links": {
       "self": {
           "href": "/clinic"
       },
       "first": {
           "href": "/clinic?page={page}"
       },
       "prev": {
           "href": "/clinic?page={page}"
       },
       "next": {
           "href": "/clinic?page={page}"
       },
       "last": {
           "href": "/clinic?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/clinic[/:clinic_id]"
                   }
               }
              "id": "ID da clínica",
              "name": "Nome da clínica",
              "phone": "Telefone da clínica",
              "manager": "Gerente da clínica",
              "employees": "Funcionários de uma clínica",
              "nurseries": "Enfermarias de uma cínica",
              "address": "Endereço da clínica"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Persiste uma clínica.',
                'request' => '{
   "id": "ID da clínica",
   "name": "Nome da clínica",
   "phone": "Telefone da clínica",
   "manager": "Gerente da clínica",
   "employees": "Funcionários de uma clínica",
   "nurseries": "Enfermarias de uma cínica",
   "address": "Endereço da clínica"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/clinic[/:clinic_id]"
       }
   }
   "id": "ID da clínica",
   "name": "Nome da clínica",
   "phone": "Telefone da clínica",
   "manager": "Gerente da clínica",
   "employees": "Funcionários de uma clínica",
   "nurseries": "Enfermarias de uma cínica",
   "address": "Endereço da clínica"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Recupera uma clínica',
                'response' => '{
   "_links": {
       "self": {
           "href": "/clinic[/:clinic_id]"
       }
   }
   "id": "ID da clínica",
   "name": "Nome da clínica",
   "phone": "Telefone da clínica",
   "manager": "Gerente da clínica",
   "employees": "Funcionários de uma clínica",
   "nurseries": "Enfermarias de uma cínica",
   "address": "Endereço da clínica"
}',
            ],
            'DELETE' => [
                'description' => 'Remove uma clínica',
                'request' => '{
   "id": "ID da clínica",
   "name": "Nome da clínica",
   "phone": "Telefone da clínica",
   "manager": "Gerente da clínica",
   "employees": "Funcionários de uma clínica",
   "nurseries": "Enfermarias de uma cínica",
   "address": "Endereço da clínica"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/clinic[/:clinic_id]"
       }
   }
   "id": "ID da clínica",
   "name": "Nome da clínica",
   "phone": "Telefone da clínica",
   "manager": "Gerente da clínica",
   "employees": "Funcionários de uma clínica",
   "nurseries": "Enfermarias de uma cínica",
   "address": "Endereço da clínica"
}',
            ],
        ],
    ],
    'API\\V1\\Rest\\Employee\\Controller' => [
        'description' => 'REST para manter um funcionário',
        'collection' => [
            'GET' => [
                'description' => 'Recupera lista de funcionários',
                'response' => '{
   "_links": {
       "self": {
           "href": "/employee"
       },
       "first": {
           "href": "/employee?page={page}"
       },
       "prev": {
           "href": "/employee?page={page}"
       },
       "next": {
           "href": "/employee?page={page}"
       },
       "last": {
           "href": "/employee?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/employee[/:employee_id]"
                   }
               }
              "id": "ID do funcionário",
              "user": "Usuário do funcionário",
              "clinic": "Clínica do funcionário"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Persiste um usuário',
                'request' => '{
   "id": "ID do funcionário",
   "user": "Usuário do funcionário",
   "clinic": "Clínica do funcionário"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/employee[/:employee_id]"
       }
   }
   "id": "ID do funcionário",
   "user": "Usuário do funcionário",
   "clinic": "Clínica do funcionário"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Recupera um funcionário',
                'response' => '{
   "_links": {
       "self": {
           "href": "/employee[/:employee_id]"
       }
   }
   "id": "ID do funcionário",
   "user": "Usuário do funcionário",
   "clinic": "Clínica do funcionário"
}',
            ],
            'DELETE' => [
                'description' => 'Remove um funcionário',
                'request' => '{
   "id": "ID do funcionário",
   "user": "Usuário do funcionário",
   "clinic": "Clínica do funcionário"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/employee[/:employee_id]"
       }
   }
   "id": "ID do funcionário",
   "user": "Usuário do funcionário",
   "clinic": "Clínica do funcionário"
}',
            ],
        ],
    ],
    'API\\V1\\Rest\\Newsletter\\Controller' => [
        'collection' => [
            'GET' => [
                'description' => 'Recupera lista de emails',
                'response' => '{
   "_links": {
       "self": {
           "href": "/newsletter"
       },
       "first": {
           "href": "/newsletter?page={page}"
       },
       "prev": {
           "href": "/newsletter?page={page}"
       },
       "next": {
           "href": "/newsletter?page={page}"
       },
       "last": {
           "href": "/newsletter?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/newsletter[/:newsletter_id]"
                   }
               }
              "email": "E-mail a ser adicionado/removido da lista"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Persiste um email na lista',
                'request' => '{
   "email": "E-mail a ser adicionado/removido da lista"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/newsletter[/:newsletter_id]"
       }
   }
   "email": "E-mail a ser adicionado/removido da lista"
}',
            ],
        ],
        'description' => 'REST para manter newsletters',
        'entity' => [
            'DELETE' => [
                'description' => 'Remove um email da lista',
                'request' => '{
   "email": "E-mail a ser adicionado/removido da lista"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/newsletter[/:newsletter_id]"
       }
   }
   "email": "E-mail a ser adicionado/removido da lista"
}',
            ],
        ],
    ],
    'API\\V1\\Rest\\Pet\\Controller' => [
        'description' => 'REST para manter um pet',
        'collection' => [
            'GET' => [
                'description' => 'Recupera lista de pet',
                'response' => '{
   "_links": {
       "self": {
           "href": "/pet"
       },
       "first": {
           "href": "/pet?page={page}"
       },
       "prev": {
           "href": "/pet?page={page}"
       },
       "next": {
           "href": "/pet?page={page}"
       },
       "last": {
           "href": "/pet?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/pet[/:pet_id]"
                   }
               }
              "id": "ID do pet",
              "name": "Nome do pet",
              "sex": "Sexo do pet",
              "orign": "Origem do pet (urbana ou rural)",
              "pedigree": "Pedigree do pet",
              "race": "Raça do pet",
              "owner": "Dono do pet",
              "photo": "Foto do pet"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Persiste um pet',
                'request' => '{
   "id": "ID do pet",
   "name": "Nome do pet",
   "sex": "Sexo do pet",
   "orign": "Origem do pet (urbana ou rural)",
   "pedigree": "Pedigree do pet",
   "race": "Raça do pet",
   "owner": "Dono do pet",
   "photo": "Foto do pet"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/pet[/:pet_id]"
       }
   }
   "id": "ID do pet",
   "name": "Nome do pet",
   "sex": "Sexo do pet",
   "orign": "Origem do pet (urbana ou rural)",
   "pedigree": "Pedigree do pet",
   "race": "Raça do pet",
   "owner": "Dono do pet",
   "photo": "Foto do pet"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Recupera um pet',
                'response' => '{
   "_links": {
       "self": {
           "href": "/pet[/:pet_id]"
       }
   }
   "id": "ID do pet",
   "name": "Nome do pet",
   "sex": "Sexo do pet",
   "orign": "Origem do pet (urbana ou rural)",
   "pedigree": "Pedigree do pet",
   "race": "Raça do pet",
   "owner": "Dono do pet",
   "photo": "Foto do pet"
}',
            ],
            'DELETE' => [
                'description' => 'Remove um pet',
                'request' => '{
   "id": "ID do pet",
   "name": "Nome do pet",
   "sex": "Sexo do pet",
   "orign": "Origem do pet (urbana ou rural)",
   "pedigree": "Pedigree do pet",
   "race": "Raça do pet",
   "owner": "Dono do pet",
   "photo": "Foto do pet"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/pet[/:pet_id]"
       }
   }
   "id": "ID do pet",
   "name": "Nome do pet",
   "sex": "Sexo do pet",
   "orign": "Origem do pet (urbana ou rural)",
   "pedigree": "Pedigree do pet",
   "race": "Raça do pet",
   "owner": "Dono do pet",
   "photo": "Foto do pet"
}',
            ],
        ],
    ],
    'API\\V1\\Rest\\History\\Controller' => [
        'collection' => [
            'description' => '',
            'GET' => [
                'description' => 'Recupera lista de histórias',
                'response' => '{
   "_links": {
       "self": {
           "href": "/history"
       },
       "first": {
           "href": "/history?page={page}"
       },
       "prev": {
           "href": "/history?page={page}"
       },
       "next": {
           "href": "/history?page={page}"
       },
       "last": {
           "href": "/history?page={page}"
       }
   }
   "_embedded": {
       "list": [
           {
               "_links": {
                   "self": {
                       "href": "/history[/:history_id]"
                   }
               }
              "id": "ID da história",
              "veterinary": "Veterinário responsável pelo atendimento",
              "employee": "Funcionário que está executando a história",
              "pet": "Pet que receberá o atendimento"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Persiste um atendimento',
                'request' => '{
   "id": "ID da história",
   "veterinary": "Veterinário responsável pelo atendimento",
   "employee": "Funcionário que está executando a história",
   "pet": "Pet que receberá o atendimento"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/history[/:history_id]"
       }
   }
   "id": "ID da história",
   "veterinary": "Veterinário responsável pelo atendimento",
   "employee": "Funcionário que está executando a história",
   "pet": "Pet que receberá o atendimento"
}',
            ],
        ],
        'description' => 'REST para manter histórias de atendimento',
        'entity' => [
            'GET' => [
                'description' => 'Recupera um atendimento',
                'response' => '{
   "_links": {
       "self": {
           "href": "/history[/:history_id]"
       }
   }
   "id": "ID da história",
   "veterinary": "Veterinário responsável pelo atendimento",
   "employee": "Funcionário que está executando a história",
   "pet": "Pet que receberá o atendimento"
}',
            ],
            'DELETE' => [
                'description' => 'Remove um atendimento',
                'request' => '{
   "id": "ID da história",
   "veterinary": "Veterinário responsável pelo atendimento",
   "employee": "Funcionário que está executando a história",
   "pet": "Pet que receberá o atendimento"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/history[/:history_id]"
       }
   }
   "id": "ID da história",
   "veterinary": "Veterinário responsável pelo atendimento",
   "employee": "Funcionário que está executando a história",
   "pet": "Pet que receberá o atendimento"
}',
            ],
        ],
    ],
];

<?php
return [
    'doctrine' => [
        'driver' => [
            'API_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => './module/API/src/V1/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'API' => 'API_driver',
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'API\\V1\\Rpc\\LoginClient\\Controller' => \API\V1\Rpc\LoginClient\LoginClientControllerFactory::class,
            'API\\V1\\Rpc\\PasswordChange\\Controller' => \API\V1\Rpc\PasswordChange\PasswordChangeControllerFactory::class,
            'API\\V1\\Rpc\\ForgotPassword\\Controller' => \API\V1\Rpc\ForgotPassword\ForgotPasswordControllerFactory::class,
            'API\\V1\\Rpc\\ActiveUser\\Controller' => \API\V1\Rpc\ActiveUser\ActiveUserControllerFactory::class,
            'API\\V1\\Rpc\\LoadDictionary\\Controller' => \API\V1\Rpc\LoadDictionary\LoadDictionaryControllerFactory::class,
            'API\\V1\\Rpc\\SearchInDictionary\\Controller' => \API\V1\Rpc\SearchInDictionary\SearchInDictionaryControllerFactory::class,
            'API\\V1\\Rpc\\SaveTranslation\\Controller' => \API\V1\Rpc\SaveTranslation\SaveTranslationControllerFactory::class,
            'API\\V1\\Rpc\\PasswordChangeToken\\Controller' => \API\V1\Rpc\PasswordChangeToken\PasswordChangeTokenControllerFactory::class,
            'API\\V1\\Rpc\\CheckEmailToken\\Controller' => \API\V1\Rpc\CheckEmailToken\CheckEmailTokenControllerFactory::class,
            'API\\V1\\Rpc\\ChangeClinic\\Controller' => \API\V1\Rpc\ChangeClinic\ChangeClinicControllerFactory::class,
            'API\\V1\\Rpc\\AllRaces\\Controller' => \API\V1\Rpc\AllRaces\AllRacesControllerFactory::class,
            'API\\V1\\Rpc\\QRCodeTest\\Controller' => \API\V1\Rpc\QRCodeTest\QRCodeTestControllerFactory::class,
            'API\\V1\\Rpc\\AddNursery\\Controller' => \API\V1\Rpc\AddNursery\AddNurseryControllerFactory::class,
            'API\\V1\\Rpc\\UpdateLangs\\Controller' => \API\V1\Rpc\UpdateLangs\UpdateLangsControllerFactory::class,
            'API\\V1\\Rpc\\LoadNursery\\Controller' => \API\V1\Rpc\LoadNursery\LoadNurseryControllerFactory::class,
            'API\\V1\\Rpc\\AddHistory\\Controller' => \API\V1\Rpc\AddHistory\AddHistoryControllerFactory::class,
            'API\\V1\\Rpc\\LoadRecord\\Controller' => \API\V1\Rpc\LoadRecord\LoadRecordControllerFactory::class,
            'API\\V1\\Rpc\\LoadHospitalization\\Controller' => \API\V1\Rpc\LoadHospitalization\LoadHospitalizationControllerFactory::class,
            'API\\V1\\Rpc\\UploadResultado\\Controller' => \API\V1\Rpc\UploadResultado\UploadResultadoControllerFactory::class,
            'API\\V1\\Rpc\\HistoryDetail\\Controller' => \API\V1\Rpc\HistoryDetail\HistoryDetailControllerFactory::class,
            'API\\V1\\Rpc\\NurseryDischarge\\Controller' => \API\V1\Rpc\NurseryDischarge\NurseryDischargeControllerFactory::class,
            'API\\V1\\Rpc\\SearchPet\\Controller' => \API\V1\Rpc\SearchPet\SearchPetControllerFactory::class,
            'API\\V1\\Rpc\\AddPetClinic\\Controller' => \API\V1\Rpc\AddPetClinic\AddPetClinicControllerFactory::class,
            'API\\V1\\Rpc\\UpdateService\\Controller' => \API\V1\Rpc\UpdateService\UpdateServiceControllerFactory::class,
            'API\\V1\\Rpc\\LoadServices\\Controller' => \API\V1\Rpc\LoadServices\LoadServicesControllerFactory::class,
            'API\\V1\\Rpc\\LoadGroomingInfo\\Controller' => \API\V1\Rpc\LoadGroomingInfo\LoadGroomingInfoControllerFactory::class,
            'API\\V1\\Rpc\\LoadGroomingServices\\Controller' => \API\V1\Rpc\LoadGroomingServices\LoadGroomingServicesControllerFactory::class,
            'API\\V1\\Rpc\\SaveGroomingPet\\Controller' => \API\V1\Rpc\SaveGroomingPet\SaveGroomingPetControllerFactory::class,
            'API\\V1\\Rpc\\LoadGroomingPet\\Controller' => \API\V1\Rpc\LoadGroomingPet\LoadGroomingPetControllerFactory::class,
            'API\\V1\\Rpc\\RegisterStart\\Controller' => \API\V1\Rpc\RegisterStart\RegisterStartControllerFactory::class,
            'API\\V1\\Rpc\\RegisterStep1\\Controller' => \API\V1\Rpc\RegisterStep1\RegisterStep1ControllerFactory::class,
            'API\\V1\\Rpc\\RegisterStep2\\Controller' => \API\V1\Rpc\RegisterStep2\RegisterStep2ControllerFactory::class,
            'API\\V1\\Rpc\\PreOrderLoader\\Controller' => \API\V1\Rpc\PreOrderLoader\PreOrderLoaderControllerFactory::class,
            'API\\V1\\Rpc\\LoadCountryPrices\\Controller' => \API\V1\Rpc\LoadCountryPrices\LoadCountryPricesControllerFactory::class,
            'API\\V1\\Rpc\\StripeHooks\\Controller' => \API\V1\Rpc\StripeHooks\StripeHooksControllerFactory::class,
            'API\\V1\\Rpc\\SendContact\\Controller' => \API\V1\Rpc\SendContact\SendContactControllerFactory::class,
            'API\\V1\\Rpc\\SavePrice\\Controller' => \API\V1\Rpc\SavePrice\SavePriceControllerFactory::class,
            'API\\V1\\Rpc\\LoadPrices\\Controller' => \API\V1\Rpc\LoadPrices\LoadPricesControllerFactory::class,
            'API\\V1\\Rpc\\RegisterProfessional\\Controller' => \API\V1\Rpc\RegisterProfessional\RegisterProfessionalControllerFactory::class,
            'API\\V1\\Rpc\\ProfessionalTerms\\Controller' => \API\V1\Rpc\ProfessionalTerms\ProfessionalTermsControllerFactory::class,
            'API\\V1\\Rpc\\MyAccount\\Controller' => \API\V1\Rpc\MyAccount\MyAccountControllerFactory::class,
            'API\\V1\\Rpc\\SaveMyAccount\\Controller' => \API\V1\Rpc\SaveMyAccount\SaveMyAccountControllerFactory::class,
            'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller' => \API\V1\Rpc\LoadRecordForMyPet\LoadRecordForMyPetControllerFactory::class,
            'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller' => \API\V1\Rpc\UploadProntuarioPdf\UploadProntuarioPdfControllerFactory::class,
            'API\\V1\\Rpc\\AddVaccine\\Controller' => \API\V1\Rpc\AddVaccine\AddVaccineControllerFactory::class,
            'API\\V1\\Rpc\\AddAbnormality\\Controller' => \API\V1\Rpc\AddAbnormality\AddAbnormalityControllerFactory::class,
            'API\\V1\\Rpc\\SaveTextHistory\\Controller' => \API\V1\Rpc\SaveTextHistory\SaveTextHistoryControllerFactory::class,
            'API\\V1\\Rpc\\AddExame\\Controller' => \API\V1\Rpc\AddExame\AddExameControllerFactory::class,
            'API\\V1\\Rpc\\RemoveExame\\Controller' => \API\V1\Rpc\RemoveExame\RemoveExameControllerFactory::class,
            'API\\V1\\Rpc\\AddMedicamento\\Controller' => \API\V1\Rpc\AddMedicamento\AddMedicamentoControllerFactory::class,
            'API\\V1\\Rpc\\RemoveMedicamento\\Controller' => \API\V1\Rpc\RemoveMedicamento\RemoveMedicamentoControllerFactory::class,
            'API\\V1\\Rpc\\LoadHistorial\\Controller' => \API\V1\Rpc\LoadHistorial\LoadHistorialControllerFactory::class,
            'API\\V1\\Rpc\\CadastroLandingpage\\Controller' => \API\V1\Rpc\CadastroLandingpage\CadastroLandingpageControllerFactory::class,
            'API\\V1\\Rpc\\GetLocationInfo\\Controller' => \API\V1\Rpc\GetLocationInfo\GetLocationInfoControllerFactory::class,
            'API\\V1\\Rpc\\LoadCupons\\Controller' => \API\V1\Rpc\LoadCupons\LoadCuponsControllerFactory::class,
            'API\\V1\\Rpc\\UpdateCupons\\Controller' => \API\V1\Rpc\UpdateCupons\UpdateCuponsControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'api.rpc.login-client' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/login-client',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoginClient\\Controller',
                        'action' => 'loginClient',
                    ],
                ],
            ],
            'api.rpc.password-change' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/password-change',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\PasswordChange\\Controller',
                        'action' => 'passwordChange',
                    ],
                ],
            ],
            'api.rest.distributor' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/distributor[/:distributor_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Distributor\\Controller',
                    ],
                ],
            ],
            'api.rest.user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user[/:user_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\User\\Controller',
                    ],
                ],
            ],
            'api.rest.clinic' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/clinic[/:clinic_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Clinic\\Controller',
                    ],
                ],
            ],
            'api.rest.employee' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/employee[/:employee_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Employee\\Controller',
                    ],
                ],
            ],
            'api.rest.newsletter' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/newsletter[/:newsletter_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Newsletter\\Controller',
                    ],
                ],
            ],
            'api.rest.pet' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/pet[/:pet_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Pet\\Controller',
                    ],
                ],
            ],
            'api.rest.history' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/history[/:history_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\History\\Controller',
                    ],
                ],
            ],
            'api.rest.image' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/image[/:image_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Image\\Controller',
                    ],
                ],
            ],
            'api.rest.i18n' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/i18n[/:i18n_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\I18n\\Controller',
                    ],
                ],
            ],
            'api.rpc.forgot-password' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/forgot-password',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\ForgotPassword\\Controller',
                        'action' => 'forgotPassword',
                    ],
                ],
            ],
            'api.rpc.active-user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/active-user',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\ActiveUser\\Controller',
                        'action' => 'activeUser',
                    ],
                ],
            ],
            'api.rpc.load-dictionary' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-dictionary',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadDictionary\\Controller',
                        'action' => 'loadDictionary',
                    ],
                ],
            ],
            'api.rpc.search-in-dictionary' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/search-in-dictionary',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SearchInDictionary\\Controller',
                        'action' => 'searchInDictionary',
                    ],
                ],
            ],
            'api.rpc.save-translation' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/save-translation',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SaveTranslation\\Controller',
                        'action' => 'saveTranslation',
                    ],
                ],
            ],
            'api.rpc.password-change-token' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/password-change-token',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\PasswordChangeToken\\Controller',
                        'action' => 'passwordChangeToken',
                    ],
                ],
            ],
            'api.rpc.check-email-token' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/check-email-token',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\CheckEmailToken\\Controller',
                        'action' => 'checkEmailToken',
                    ],
                ],
            ],
            'api.rpc.change-clinic' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/change-clinic',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\ChangeClinic\\Controller',
                        'action' => 'changeClinic',
                    ],
                ],
            ],
            'api.rpc.all-races' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/all-races',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AllRaces\\Controller',
                        'action' => 'allRaces',
                    ],
                ],
            ],
            'api.rpc.qr-code-test' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/qrcode-test',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\QRCodeTest\\Controller',
                        'action' => 'qRCodeTest',
                    ],
                ],
            ],
            'api.rpc.add-nursery' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-nursery',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddNursery\\Controller',
                        'action' => 'addNursery',
                    ],
                ],
            ],
            'api.rpc.update-langs' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/update-langs',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\UpdateLangs\\Controller',
                        'action' => 'updateLangs',
                    ],
                ],
            ],
            'api.rpc.load-nursery' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-nursery',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadNursery\\Controller',
                        'action' => 'loadNursery',
                    ],
                ],
            ],
            'api.rpc.add-history' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-history',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddHistory\\Controller',
                        'action' => 'addHistory',
                    ],
                ],
            ],
            'api.rpc.load-record' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-record',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadRecord\\Controller',
                        'action' => 'loadRecord',
                    ],
                ],
            ],
            'api.rpc.load-hospitalization' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-hospitalization',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadHospitalization\\Controller',
                        'action' => 'loadHospitalization',
                    ],
                ],
            ],
            'api.rpc.upload-resultado' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/upload-resultado',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\UploadResultado\\Controller',
                        'action' => 'uploadResultado',
                    ],
                ],
            ],
            'api.rpc.history-detail' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/history-detail',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\HistoryDetail\\Controller',
                        'action' => 'historyDetail',
                    ],
                ],
            ],
            'api.rpc.nursery-discharge' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/nursery-discharge',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\NurseryDischarge\\Controller',
                        'action' => 'nurseryDischarge',
                    ],
                ],
            ],
            'api.rpc.search-pet' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/search-pet',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SearchPet\\Controller',
                        'action' => 'searchPet',
                    ],
                ],
            ],
            'api.rpc.add-pet-clinic' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-pet-to-clinic',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddPetClinic\\Controller',
                        'action' => 'addPetClinic',
                    ],
                ],
            ],
            'api.rpc.update-service' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/update-service',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\UpdateService\\Controller',
                        'action' => 'updateService',
                    ],
                ],
            ],
            'api.rpc.load-services' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-services',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadServices\\Controller',
                        'action' => 'loadServices',
                    ],
                ],
            ],
            'api.rpc.load-grooming-info' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-grooming-info',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadGroomingInfo\\Controller',
                        'action' => 'loadGroomingInfo',
                    ],
                ],
            ],
            'api.rpc.load-grooming-services' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-grooming-services',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadGroomingServices\\Controller',
                        'action' => 'loadGroomingServices',
                    ],
                ],
            ],
            'api.rpc.save-grooming-pet' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/save-grooming-pet',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SaveGroomingPet\\Controller',
                        'action' => 'saveGroomingPet',
                    ],
                ],
            ],
            'api.rpc.load-grooming-pet' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-grooming-pet',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadGroomingPet\\Controller',
                        'action' => 'loadGroomingPet',
                    ],
                ],
            ],
            'api.rest.report' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/report[/:report_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Report\\Controller',
                    ],
                ],
            ],
            'api.rpc.register-start' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/register-start',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\RegisterStart\\Controller',
                        'action' => 'registerStart',
                    ],
                ],
            ],
            'api.rpc.register-step1' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/register-step-1',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\RegisterStep1\\Controller',
                        'action' => 'registerStep1',
                    ],
                ],
            ],
            'api.rpc.register-step2' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/register-step-2',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\RegisterStep2\\Controller',
                        'action' => 'registerStep2',
                    ],
                ],
            ],
            'api.rpc.pre-order-loader' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/preorder-loader',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\PreOrderLoader\\Controller',
                        'action' => 'preOrderLoader',
                    ],
                ],
            ],
            'api.rpc.load-country-prices' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-country-prices',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadCountryPrices\\Controller',
                        'action' => 'loadCountryPrices',
                    ],
                ],
            ],
            'api.rpc.stripe-hooks' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/stripe-hooks',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\StripeHooks\\Controller',
                        'action' => 'stripeHooks',
                    ],
                ],
            ],
            'api.rpc.send-contact' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/send-contact',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SendContact\\Controller',
                        'action' => 'sendContact',
                    ],
                ],
            ],
            'api.rpc.save-price' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/save-price',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SavePrice\\Controller',
                        'action' => 'savePrice',
                    ],
                ],
            ],
            'api.rpc.load-prices' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-prices',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadPrices\\Controller',
                        'action' => 'loadPrices',
                    ],
                ],
            ],
            'api.rpc.register-professional' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/register-professional',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\RegisterProfessional\\Controller',
                        'action' => 'registerProfessional',
                    ],
                ],
            ],
            'api.rpc.professional-terms' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/professional-terms',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\ProfessionalTerms\\Controller',
                        'action' => 'professionalTerms',
                    ],
                ],
            ],
            'api.rpc.my-account' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/my-account',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\MyAccount\\Controller',
                        'action' => 'myAccount',
                    ],
                ],
            ],
            'api.rpc.save-my-account' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/save-my-account',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SaveMyAccount\\Controller',
                        'action' => 'saveMyAccount',
                    ],
                ],
            ],
            'api.rpc.load-record-for-my-pet' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-record-for-my-pet',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller',
                        'action' => 'loadRecordForMyPet',
                    ],
                ],
            ],
            'api.rpc.upload-prontuario-pdf' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/upload-prontuario-pdf',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller',
                        'action' => 'uploadProntuarioPdf',
                    ],
                ],
            ],
            'api.rpc.add-vaccine' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-vaccine',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddVaccine\\Controller',
                        'action' => 'addVaccine',
                    ],
                ],
            ],
            'api.rest.history-action' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/history-action[/:history_action_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\HistoryAction\\Controller',
                    ],
                ],
            ],
            'api.rpc.add-abnormality' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-abnormality',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddAbnormality\\Controller',
                        'action' => 'addAbnormality',
                    ],
                ],
            ],
            'api.rpc.save-text-history' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/save-text-history',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\SaveTextHistory\\Controller',
                        'action' => 'saveTextHistory',
                    ],
                ],
            ],
            'api.rpc.add-exame' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-exame',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddExame\\Controller',
                        'action' => 'addExame',
                    ],
                ],
            ],
            'api.rpc.remove-exame' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/remove-exame',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\RemoveExame\\Controller',
                        'action' => 'removeExame',
                    ],
                ],
            ],
            'api.rpc.add-medicamento' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/add-medicamento',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\AddMedicamento\\Controller',
                        'action' => 'addMedicamento',
                    ],
                ],
            ],
            'api.rpc.remove-medicamento' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/remove-medicamento',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\RemoveMedicamento\\Controller',
                        'action' => 'removeMedicamento',
                    ],
                ],
            ],
            'api.rpc.load-historial' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-historial',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadHistorial\\Controller',
                        'action' => 'loadHistorial',
                    ],
                ],
            ],
            'api.rpc.cadastro-landingpage' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/cadastro-landingpage',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\CadastroLandingpage\\Controller',
                        'action' => 'cadastroLandingpage',
                    ],
                ],
            ],
            'api.rpc.get-location-info' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/get-location-info',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\GetLocationInfo\\Controller',
                        'action' => 'getLocationInfo',
                    ],
                ],
            ],
            'api.rest.promoter' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/promoter[/:promoter_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Promoter\\Controller',
                    ],
                ],
            ],
            'api.rpc.load-cupons' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/load-cupons',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\LoadCupons\\Controller',
                        'action' => 'loadCupons',
                    ],
                ],
            ],
            'api.rpc.update-cupons' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/update-cupons',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rpc\\UpdateCupons\\Controller',
                        'action' => 'updateCupons',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'api.rpc.login-client',
            1 => 'api.rpc.password-change',
            2 => 'api.rest.distributor',
            3 => 'api.rest.user',
            4 => 'api.rest.clinic',
            5 => 'api.rest.employee',
            6 => 'api.rest.newsletter',
            7 => 'api.rest.pet',
            8 => 'api.rest.history',
            9 => 'api.rest.image',
            10 => 'api.rest.i18n',
            11 => 'api.rpc.forgot-password',
            12 => 'api.rpc.active-user',
            13 => 'api.rpc.load-dictionary',
            14 => 'api.rpc.search-in-dictionary',
            15 => 'api.rpc.save-translation',
            16 => 'api.rpc.password-change-token',
            17 => 'api.rpc.check-email-token',
            18 => 'api.rpc.change-clinic',
            19 => 'api.rpc.all-races',
            20 => 'api.rpc.qr-code-test',
            21 => 'api.rpc.add-nursery',
            22 => 'api.rpc.update-langs',
            23 => 'api.rpc.load-nursery',
            24 => 'api.rpc.add-history',
            25 => 'api.rpc.load-record',
            26 => 'api.rpc.load-hospitalization',
            27 => 'api.rpc.upload-resultado',
            28 => 'api.rpc.history-detail',
            29 => 'api.rpc.nursery-discharge',
            30 => 'api.rpc.search-pet',
            31 => 'api.rpc.add-pet-clinic',
            32 => 'api.rpc.update-service',
            33 => 'api.rpc.load-services',
            34 => 'api.rpc.load-grooming-info',
            35 => 'api.rpc.load-grooming-services',
            36 => 'api.rpc.save-grooming-pet',
            37 => 'api.rpc.load-grooming-pet',
            38 => 'api.rest.report',
            39 => 'api.rpc.register-start',
            40 => 'api.rpc.register-step1',
            41 => 'api.rpc.register-step2',
            42 => 'api.rpc.pre-order-loader',
            43 => 'api.rpc.load-country-prices',
            44 => 'api.rpc.stripe-hooks',
            45 => 'api.rpc.send-contact',
            46 => 'api.rpc.save-price',
            47 => 'api.rpc.load-prices',
            48 => 'api.rpc.register-professional',
            49 => 'api.rpc.professional-terms',
            50 => 'api.rpc.my-account',
            51 => 'api.rpc.save-my-account',
            52 => 'api.rpc.load-record-for-my-pet',
            53 => 'api.rpc.upload-prontuario-pdf',
            54 => 'api.rpc.add-vaccine',
            55 => 'api.rest.history-action',
            56 => 'api.rpc.add-abnormality',
            57 => 'api.rpc.save-text-history',
            58 => 'api.rpc.add-exame',
            59 => 'api.rpc.remove-exame',
            60 => 'api.rpc.add-medicamento',
            61 => 'api.rpc.remove-medicamento',
            62 => 'api.rpc.load-historial',
            63 => 'api.rpc.cadastro-landingpage',
            64 => 'api.rpc.get-location-info',
            65 => 'api.rest.promoter',
            66 => 'api.rpc.load-cupons',
            67 => 'api.rpc.update-cupons',
        ],
    ],
    'zf-rpc' => [
        'API\\V1\\Rpc\\LoginClient\\Controller' => [
            'service_name' => 'LoginClient',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.login-client',
        ],
        'API\\V1\\Rpc\\PasswordChange\\Controller' => [
            'service_name' => 'PasswordChange',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.password-change',
        ],
        'API\\V1\\Rpc\\ForgotPassword\\Controller' => [
            'service_name' => 'ForgotPassword',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.forgot-password',
        ],
        'API\\V1\\Rpc\\ActiveUser\\Controller' => [
            'service_name' => 'ActiveUser',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.active-user',
        ],
        'API\\V1\\Rpc\\LoadDictionary\\Controller' => [
            'service_name' => 'LoadDictionary',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-dictionary',
        ],
        'API\\V1\\Rpc\\SearchInDictionary\\Controller' => [
            'service_name' => 'SearchInDictionary',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.search-in-dictionary',
        ],
        'API\\V1\\Rpc\\SaveTranslation\\Controller' => [
            'service_name' => 'SaveTranslation',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.save-translation',
        ],
        'API\\V1\\Rpc\\PasswordChangeToken\\Controller' => [
            'service_name' => 'PasswordChangeToken',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.password-change-token',
        ],
        'API\\V1\\Rpc\\CheckEmailToken\\Controller' => [
            'service_name' => 'CheckEmailToken',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.check-email-token',
        ],
        'API\\V1\\Rpc\\ChangeClinic\\Controller' => [
            'service_name' => 'ChangeClinic',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.change-clinic',
        ],
        'API\\V1\\Rpc\\AllRaces\\Controller' => [
            'service_name' => 'AllRaces',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.all-races',
        ],
        'API\\V1\\Rpc\\QRCodeTest\\Controller' => [
            'service_name' => 'QRCodeTest',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.qr-code-test',
        ],
        'API\\V1\\Rpc\\AddNursery\\Controller' => [
            'service_name' => 'AddNursery',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-nursery',
        ],
        'API\\V1\\Rpc\\UpdateLangs\\Controller' => [
            'service_name' => 'UpdateLangs',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.update-langs',
        ],
        'API\\V1\\Rpc\\LoadNursery\\Controller' => [
            'service_name' => 'LoadNursery',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.load-nursery',
        ],
        'API\\V1\\Rpc\\AddHistory\\Controller' => [
            'service_name' => 'AddHistory',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-history',
        ],
        'API\\V1\\Rpc\\LoadRecord\\Controller' => [
            'service_name' => 'LoadRecord',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-record',
        ],
        'API\\V1\\Rpc\\LoadHospitalization\\Controller' => [
            'service_name' => 'LoadHospitalization',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-hospitalization',
        ],
        'API\\V1\\Rpc\\UploadResultado\\Controller' => [
            'service_name' => 'UploadResultado',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.upload-resultado',
        ],
        'API\\V1\\Rpc\\HistoryDetail\\Controller' => [
            'service_name' => 'HistoryDetail',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.history-detail',
        ],
        'API\\V1\\Rpc\\NurseryDischarge\\Controller' => [
            'service_name' => 'NurseryDischarge',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.nursery-discharge',
        ],
        'API\\V1\\Rpc\\SearchPet\\Controller' => [
            'service_name' => 'SearchPet',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.search-pet',
        ],
        'API\\V1\\Rpc\\AddPetClinic\\Controller' => [
            'service_name' => 'AddPetClinic',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-pet-clinic',
        ],
        'API\\V1\\Rpc\\UpdateService\\Controller' => [
            'service_name' => 'UpdateService',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.update-service',
        ],
        'API\\V1\\Rpc\\LoadServices\\Controller' => [
            'service_name' => 'LoadServices',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.load-services',
        ],
        'API\\V1\\Rpc\\LoadGroomingInfo\\Controller' => [
            'service_name' => 'LoadGroomingInfo',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-grooming-info',
        ],
        'API\\V1\\Rpc\\LoadGroomingServices\\Controller' => [
            'service_name' => 'LoadGroomingServices',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-grooming-services',
        ],
        'API\\V1\\Rpc\\SaveGroomingPet\\Controller' => [
            'service_name' => 'SaveGroomingPet',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.save-grooming-pet',
        ],
        'API\\V1\\Rpc\\LoadGroomingPet\\Controller' => [
            'service_name' => 'LoadGroomingPet',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-grooming-pet',
        ],
        'API\\V1\\Rpc\\RegisterStart\\Controller' => [
            'service_name' => 'RegisterStart',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.register-start',
        ],
        'API\\V1\\Rpc\\RegisterStep1\\Controller' => [
            'service_name' => 'RegisterStep1',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.register-step1',
        ],
        'API\\V1\\Rpc\\RegisterStep2\\Controller' => [
            'service_name' => 'RegisterStep2',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.register-step2',
        ],
        'API\\V1\\Rpc\\PreOrderLoader\\Controller' => [
            'service_name' => 'PreOrderLoader',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.pre-order-loader',
        ],
        'API\\V1\\Rpc\\LoadCountryPrices\\Controller' => [
            'service_name' => 'LoadCountryPrices',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.load-country-prices',
        ],
        'API\\V1\\Rpc\\StripeHooks\\Controller' => [
            'service_name' => 'StripeHooks',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.stripe-hooks',
        ],
        'API\\V1\\Rpc\\SendContact\\Controller' => [
            'service_name' => 'SendContact',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.send-contact',
        ],
        'API\\V1\\Rpc\\SavePrice\\Controller' => [
            'service_name' => 'SavePrice',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.save-price',
        ],
        'API\\V1\\Rpc\\LoadPrices\\Controller' => [
            'service_name' => 'LoadPrices',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.load-prices',
        ],
        'API\\V1\\Rpc\\RegisterProfessional\\Controller' => [
            'service_name' => 'RegisterProfessional',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.register-professional',
        ],
        'API\\V1\\Rpc\\ProfessionalTerms\\Controller' => [
            'service_name' => 'ProfessionalTerms',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.professional-terms',
        ],
        'API\\V1\\Rpc\\MyAccount\\Controller' => [
            'service_name' => 'MyAccount',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.my-account',
        ],
        'API\\V1\\Rpc\\SaveMyAccount\\Controller' => [
            'service_name' => 'SaveMyAccount',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.save-my-account',
        ],
        'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller' => [
            'service_name' => 'LoadRecordForMyPet',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-record-for-my-pet',
        ],
        'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller' => [
            'service_name' => 'UploadProntuarioPdf',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.upload-prontuario-pdf',
        ],
        'API\\V1\\Rpc\\AddVaccine\\Controller' => [
            'service_name' => 'AddVaccine',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-vaccine',
        ],
        'API\\V1\\Rpc\\AddAbnormality\\Controller' => [
            'service_name' => 'AddAbnormality',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-abnormality',
        ],
        'API\\V1\\Rpc\\SaveTextHistory\\Controller' => [
            'service_name' => 'SaveTextHistory',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.save-text-history',
        ],
        'API\\V1\\Rpc\\AddExame\\Controller' => [
            'service_name' => 'AddExame',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-exame',
        ],
        'API\\V1\\Rpc\\RemoveExame\\Controller' => [
            'service_name' => 'RemoveExame',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.remove-exame',
        ],
        'API\\V1\\Rpc\\AddMedicamento\\Controller' => [
            'service_name' => 'AddMedicamento',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.add-medicamento',
        ],
        'API\\V1\\Rpc\\RemoveMedicamento\\Controller' => [
            'service_name' => 'RemoveMedicamento',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.remove-medicamento',
        ],
        'API\\V1\\Rpc\\LoadHistorial\\Controller' => [
            'service_name' => 'LoadHistorial',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.load-historial',
        ],
        'API\\V1\\Rpc\\CadastroLandingpage\\Controller' => [
            'service_name' => 'CadastroLandingpage',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.cadastro-landingpage',
        ],
        'API\\V1\\Rpc\\GetLocationInfo\\Controller' => [
            'service_name' => 'GetLocationInfo',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.get-location-info',
        ],
        'API\\V1\\Rpc\\LoadCupons\\Controller' => [
            'service_name' => 'LoadCupons',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'api.rpc.load-cupons',
        ],
        'API\\V1\\Rpc\\UpdateCupons\\Controller' => [
            'service_name' => 'UpdateCupons',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'api.rpc.update-cupons',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'API\\V1\\Rpc\\LoginClient\\Controller' => 'Json',
            'API\\V1\\Rpc\\PasswordChange\\Controller' => 'Json',
            'API\\V1\\Rest\\Distributor\\Controller' => 'HalJson',
            'API\\V1\\Rest\\User\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Clinic\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Employee\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Newsletter\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Pet\\Controller' => 'HalJson',
            'API\\V1\\Rest\\History\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Image\\Controller' => 'HalJson',
            'API\\V1\\Rest\\I18n\\Controller' => 'Json',
            'API\\V1\\Rpc\\ForgotPassword\\Controller' => 'Json',
            'API\\V1\\Rpc\\ActiveUser\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadDictionary\\Controller' => 'Json',
            'API\\V1\\Rpc\\SearchInDictionary\\Controller' => 'Json',
            'API\\V1\\Rpc\\SaveTranslation\\Controller' => 'Json',
            'API\\V1\\Rpc\\PasswordChangeToken\\Controller' => 'Json',
            'API\\V1\\Rpc\\CheckEmailToken\\Controller' => 'Json',
            'API\\V1\\Rpc\\ChangeClinic\\Controller' => 'Json',
            'API\\V1\\Rpc\\AllRaces\\Controller' => 'Json',
            'API\\V1\\Rpc\\QRCodeTest\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddNursery\\Controller' => 'Json',
            'API\\V1\\Rpc\\UpdateLangs\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadNursery\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddHistory\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadRecord\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadHospitalization\\Controller' => 'Json',
            'API\\V1\\Rpc\\UploadResultado\\Controller' => 'Json',
            'API\\V1\\Rpc\\HistoryDetail\\Controller' => 'Json',
            'API\\V1\\Rpc\\NurseryDischarge\\Controller' => 'Json',
            'API\\V1\\Rpc\\SearchPet\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddPetClinic\\Controller' => 'Json',
            'API\\V1\\Rpc\\UpdateService\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadServices\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadGroomingInfo\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadGroomingServices\\Controller' => 'Json',
            'API\\V1\\Rpc\\SaveGroomingPet\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadGroomingPet\\Controller' => 'Json',
            'API\\V1\\Rest\\Report\\Controller' => 'HalJson',
            'API\\V1\\Rpc\\RegisterStart\\Controller' => 'Json',
            'API\\V1\\Rpc\\RegisterStep1\\Controller' => 'Json',
            'API\\V1\\Rpc\\RegisterStep2\\Controller' => 'Json',
            'API\\V1\\Rpc\\PreOrderLoader\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadCountryPrices\\Controller' => 'Json',
            'API\\V1\\Rpc\\StripeHooks\\Controller' => 'Json',
            'API\\V1\\Rpc\\SendContact\\Controller' => 'Json',
            'API\\V1\\Rpc\\SavePrice\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadPrices\\Controller' => 'Json',
            'API\\V1\\Rpc\\RegisterProfessional\\Controller' => 'Json',
            'API\\V1\\Rpc\\ProfessionalTerms\\Controller' => 'Json',
            'API\\V1\\Rpc\\MyAccount\\Controller' => 'Json',
            'API\\V1\\Rpc\\SaveMyAccount\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller' => 'Json',
            'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddVaccine\\Controller' => 'Json',
            'API\\V1\\Rest\\HistoryAction\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddAbnormality\\Controller' => 'Json',
            'API\\V1\\Rpc\\SaveTextHistory\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddExame\\Controller' => 'Json',
            'API\\V1\\Rpc\\RemoveExame\\Controller' => 'Json',
            'API\\V1\\Rpc\\AddMedicamento\\Controller' => 'Json',
            'API\\V1\\Rpc\\RemoveMedicamento\\Controller' => 'Json',
            'API\\V1\\Rpc\\LoadHistorial\\Controller' => 'Json',
            'API\\V1\\Rpc\\CadastroLandingpage\\Controller' => 'Json',
            'API\\V1\\Rpc\\GetLocationInfo\\Controller' => 'Json',
            'API\\V1\\Rest\\Promoter\\Controller' => 'HalJson',
            'API\\V1\\Rpc\\LoadCupons\\Controller' => 'Json',
            'API\\V1\\Rpc\\UpdateCupons\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'API\\V1\\Rpc\\LoginClient\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\PasswordChange\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rest\\Distributor\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Clinic\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Employee\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Newsletter\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Pet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\History\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Image\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\I18n\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rpc\\ForgotPassword\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\ActiveUser\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadDictionary\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SearchInDictionary\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SaveTranslation\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\PasswordChangeToken\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\CheckEmailToken\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\ChangeClinic\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AllRaces\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\QRCodeTest\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AddNursery\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\UpdateLangs\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadNursery\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AddHistory\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadRecord\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadHospitalization\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\UploadResultado\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\HistoryDetail\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\NurseryDischarge\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SearchPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AddPetClinic\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\UpdateService\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadServices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadGroomingInfo\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadGroomingServices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SaveGroomingPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadGroomingPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rest\\Report\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rpc\\RegisterStart\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\RegisterStep1\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\RegisterStep2\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\PreOrderLoader\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadCountryPrices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\StripeHooks\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SendContact\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SavePrice\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadPrices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\RegisterProfessional\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\ProfessionalTerms\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\MyAccount\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SaveMyAccount\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AddVaccine\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rest\\HistoryAction\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddAbnormality\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\SaveTextHistory\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AddExame\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\RemoveExame\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\AddMedicamento\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\RemoveMedicamento\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\LoadHistorial\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\CadastroLandingpage\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\GetLocationInfo\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rest\\Promoter\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadCupons\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'API\\V1\\Rpc\\UpdateCupons\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'API\\V1\\Rpc\\LoginClient\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\PasswordChange\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Distributor\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Clinic\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Employee\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Newsletter\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Pet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\History\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Image\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\I18n\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\ForgotPassword\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\ActiveUser\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadDictionary\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SearchInDictionary\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SaveTranslation\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\PasswordChangeToken\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\CheckEmailToken\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\ChangeClinic\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AllRaces\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\QRCodeTest\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddNursery\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\UpdateLangs\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadNursery\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddHistory\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadRecord\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadHospitalization\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\UploadResultado\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\HistoryDetail\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\NurseryDischarge\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SearchPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddPetClinic\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\UpdateService\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadServices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadGroomingInfo\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadGroomingServices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SaveGroomingPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadGroomingPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Report\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\RegisterStart\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\RegisterStep1\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\RegisterStep2\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\PreOrderLoader\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadCountryPrices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\StripeHooks\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SendContact\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SavePrice\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadPrices\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\RegisterProfessional\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\ProfessionalTerms\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\MyAccount\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SaveMyAccount\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddVaccine\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\HistoryAction\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddAbnormality\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\SaveTextHistory\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddExame\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\RemoveExame\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\AddMedicamento\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\RemoveMedicamento\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadHistorial\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\CadastroLandingpage\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\GetLocationInfo\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Promoter\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\LoadCupons\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rpc\\UpdateCupons\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'API\\V1\\Rpc\\LoginClient\\Controller' => [
            'input_filter' => 'API\\V1\\Rpc\\LoginClient\\Validator',
        ],
        'API\\V1\\Rpc\\PasswordChange\\Controller' => [
            'input_filter' => 'API\\V1\\Rpc\\PasswordChange\\Validator',
        ],
        'API\\V1\\Rest\\Distributor\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Distributor\\Validator',
        ],
        'API\\V1\\Rest\\User\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\User\\Validator',
        ],
        'API\\V1\\Rest\\Clinic\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Clinic\\Validator',
        ],
        'API\\V1\\Rest\\Employee\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Employee\\Validator',
        ],
        'API\\V1\\Rest\\Newsletter\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Newsletter\\Validator',
        ],
        'API\\V1\\Rest\\Pet\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Pet\\Validator',
        ],
        'API\\V1\\Rest\\History\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\History\\Validator',
        ],
        'API\\V1\\Rest\\Image\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Image\\Validator',
        ],
        'API\\V1\\Rpc\\RegisterStep1\\Controller' => [
            'input_filter' => 'API\\V1\\Rpc\\RegisterStep1\\Validator',
        ],
        'API\\V1\\Rpc\\RegisterStep2\\Controller' => [
            'input_filter' => 'API\\V1\\Rpc\\RegisterStep2\\Validator',
        ],
        'API\\V1\\Rpc\\PreOrderLoader\\Controller' => [
            'input_filter' => 'API\\V1\\Rpc\\PreOrderLoader\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'API\\V1\\Rpc\\LoginClient\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'username',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'password',
                'field_type' => 'string',
            ],
        ],
        'API\\V1\\Rpc\\PasswordChange\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'password',
                'field_type' => 'string',
                'description' => 'Nova senha',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'old',
                'description' => 'Senha antiga para validação',
                'field_type' => 'string',
            ],
        ],
        'API\\V1\\Rest\\Distributor\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID do distribuidor',
            ],
        ],
        'API\\V1\\Rest\\User\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'username',
                'description' => 'Nome de usuário',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID do usuário',
                'field_type' => '',
            ],
        ],
        'API\\V1\\Rest\\Clinic\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID da clínica',
            ],
        ],
        'API\\V1\\Rest\\Employee\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID do funcionário',
            ],
        ],
        'API\\V1\\Rest\\Newsletter\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'email',
                'field_type' => 'string',
                'description' => 'E-mail a ser adicionado/removido da lista',
            ],
        ],
        'API\\V1\\Rest\\Pet\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID do pet',
            ],
        ],
        'API\\V1\\Rest\\History\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID da história',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'veterinary',
                'description' => 'Veterinário responsável pelo atendimento',
                'field_type' => 'Veterinary',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'employee',
                'description' => 'Funcionário que está executando a história',
                'field_type' => 'Employee',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'pet',
                'description' => 'Pet que receberá o atendimento',
                'field_type' => 'Pet',
            ],
        ],
        'API\\V1\\Rest\\Image\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'ID da imagem, documento, audio ou vídeo',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'mime',
                'description' => 'Mime type do arquivo',
                'field_type' => 'string',
            ],
        ],
        'API\\V1\\Rpc\\RegisterStep1\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'nome',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'nascimento',
                'field_type' => '',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'sexo',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'especie',
            ],
            4 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'raca',
            ],
            5 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'origem',
            ],
            6 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
            ],
        ],
        'API\\V1\\Rpc\\RegisterStep2\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'cep',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'endereco',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'numero',
            ],
            3 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'complemento',
            ],
            4 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'bairro',
            ],
            5 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'cidade',
            ],
            6 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'estado',
            ],
            7 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'pais',
            ],
            8 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
            ],
        ],
        'API\\V1\\Rpc\\PreOrderLoader\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'link',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'API\\V1\\Rpc\\PasswordChange\\Controller' => [
                'actions' => [
                    'passwordChange' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rest\\Distributor\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\User\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\Clinic\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\Employee\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\Newsletter\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\Pet\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\History\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rest\\I18n\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rpc\\ActiveUser\\Controller' => [
                'actions' => [
                    'activeUser' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadDictionary\\Controller' => [
                'actions' => [
                    'loadDictionary' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\SearchInDictionary\\Controller' => [
                'actions' => [
                    'searchInDictionary' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\SaveTranslation\\Controller' => [
                'actions' => [
                    'saveTranslation' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\ChangeClinic\\Controller' => [
                'actions' => [
                    'changeClinic' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AllRaces\\Controller' => [
                'actions' => [
                    'allRaces' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AddNursery\\Controller' => [
                'actions' => [
                    'addNursery' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadNursery\\Controller' => [
                'actions' => [
                    'loadNursery' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AddHistory\\Controller' => [
                'actions' => [
                    'addHistory' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadRecord\\Controller' => [
                'actions' => [
                    'loadRecord' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadHospitalization\\Controller' => [
                'actions' => [
                    'loadHospitalization' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\UploadResultado\\Controller' => [
                'actions' => [
                    'uploadResultado' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\HistoryDetail\\Controller' => [
                'actions' => [
                    'historyDetail' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\NurseryDischarge\\Controller' => [
                'actions' => [
                    'nurseryDischarge' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\SearchPet\\Controller' => [
                'actions' => [
                    'searchPet' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AddPetClinic\\Controller' => [
                'actions' => [
                    'addPetClinic' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\UpdateService\\Controller' => [
                'actions' => [
                    'updateService' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadServices\\Controller' => [
                'actions' => [
                    'loadServices' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadGroomingInfo\\Controller' => [
                'actions' => [
                    'loadGroomingInfo' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadGroomingServices\\Controller' => [
                'actions' => [
                    'loadGroomingServices' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\SaveGroomingPet\\Controller' => [
                'actions' => [
                    'saveGroomingPet' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadGroomingPet\\Controller' => [
                'actions' => [
                    'loadGroomingPet' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rest\\Report\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
            'API\\V1\\Rpc\\SavePrice\\Controller' => [
                'actions' => [
                    'savePrice' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadPrices\\Controller' => [
                'actions' => [
                    'loadPrices' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\MyAccount\\Controller' => [
                'actions' => [
                    'myAccount' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\SaveMyAccount\\Controller' => [
                'actions' => [
                    'saveMyAccount' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadRecordForMyPet\\Controller' => [
                'actions' => [
                    'loadRecordForMyPet' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\UploadProntuarioPdf\\Controller' => [
                'actions' => [
                    'uploadProntuarioPdf' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AddVaccine\\Controller' => [
                'actions' => [
                    'addVaccine' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rest\\HistoryAction\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rpc\\AddAbnormality\\Controller' => [
                'actions' => [
                    'addAbnormality' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\SaveTextHistory\\Controller' => [
                'actions' => [
                    'saveTextHistory' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AddExame\\Controller' => [
                'actions' => [
                    'addExame' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\RemoveExame\\Controller' => [
                'actions' => [
                    'removeExame' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\AddMedicamento\\Controller' => [
                'actions' => [
                    'addMedicamento' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\RemoveMedicamento\\Controller' => [
                'actions' => [
                    'removeMedicamento' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\LoadHistorial\\Controller' => [
                'actions' => [
                    'loadHistorial' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rest\\Promoter\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
            'API\\V1\\Rpc\\LoadCupons\\Controller' => [
                'actions' => [
                    'loadCupons' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
            'API\\V1\\Rpc\\UpdateCupons\\Controller' => [
                'actions' => [
                    'updateCupons' => [
                        'GET' => false,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \API\V1\Rest\Distributor\DistributorResource::class => \API\V1\Rest\Distributor\DistributorResourceFactory::class,
            \API\V1\Rest\User\UserResource::class => \API\V1\Rest\User\UserResourceFactory::class,
            \API\V1\Rest\Clinic\ClinicResource::class => \API\V1\Rest\Clinic\ClinicResourceFactory::class,
            \API\V1\Rest\Employee\EmployeeResource::class => \API\V1\Rest\Employee\EmployeeResourceFactory::class,
            \API\V1\Rest\Newsletter\NewsletterResource::class => \API\V1\Rest\Newsletter\NewsletterResourceFactory::class,
            \API\V1\Rest\Pet\PetResource::class => \API\V1\Rest\Pet\PetResourceFactory::class,
            \API\V1\Rest\History\HistoryResource::class => \API\V1\Rest\History\HistoryResourceFactory::class,
            \API\V1\Rest\Image\ImageResource::class => \API\V1\Rest\Image\ImageResourceFactory::class,
            \API\V1\Rest\I18n\I18nResource::class => \API\V1\Rest\I18n\I18nResourceFactory::class,
            \API\V1\Rest\Report\ReportResource::class => \API\V1\Rest\Report\ReportResourceFactory::class,
            \API\V1\Rest\HistoryAction\HistoryActionResource::class => \API\V1\Rest\HistoryAction\HistoryActionResourceFactory::class,
            \API\V1\Rest\Promoter\PromoterResource::class => \API\V1\Rest\Promoter\PromoterResourceFactory::class,
        ],
    ],
    'zf-rest' => [
        'API\\V1\\Rest\\Distributor\\Controller' => [
            'listener' => \API\V1\Rest\Distributor\DistributorResource::class,
            'route_name' => 'api.rest.distributor',
            'route_identifier_name' => 'distributor_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Distributor::class,
            'collection_class' => \API\V1\Rest\Distributor\DistributorCollection::class,
            'service_name' => 'Distributor',
        ],
        'API\\V1\\Rest\\User\\Controller' => [
            'listener' => \API\V1\Rest\User\UserResource::class,
            'route_name' => 'api.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\User::class,
            'collection_class' => \API\V1\Rest\User\UserCollection::class,
            'service_name' => 'User',
        ],
        'API\\V1\\Rest\\Clinic\\Controller' => [
            'listener' => \API\V1\Rest\Clinic\ClinicResource::class,
            'route_name' => 'api.rest.clinic',
            'route_identifier_name' => 'clinic_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Clinic::class,
            'collection_class' => \API\V1\Rest\Clinic\ClinicCollection::class,
            'service_name' => 'Clinic',
        ],
        'API\\V1\\Rest\\Employee\\Controller' => [
            'listener' => \API\V1\Rest\Employee\EmployeeResource::class,
            'route_name' => 'api.rest.employee',
            'route_identifier_name' => 'employee_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Employee::class,
            'collection_class' => \API\V1\Rest\Employee\EmployeeCollection::class,
            'service_name' => 'Employee',
        ],
        'API\\V1\\Rest\\Newsletter\\Controller' => [
            'listener' => \API\V1\Rest\Newsletter\NewsletterResource::class,
            'route_name' => 'api.rest.newsletter',
            'route_identifier_name' => 'newsletter_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Newsletter::class,
            'collection_class' => \API\V1\Rest\Newsletter\NewsletterCollection::class,
            'service_name' => 'Newsletter',
        ],
        'API\\V1\\Rest\\Pet\\Controller' => [
            'listener' => \API\V1\Rest\Pet\PetResource::class,
            'route_name' => 'api.rest.pet',
            'route_identifier_name' => 'pet_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
                2 => 'qrcod',
                3 => 'owner',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Pet::class,
            'collection_class' => \API\V1\Rest\Pet\PetCollection::class,
            'service_name' => 'Pet',
        ],
        'API\\V1\\Rest\\History\\Controller' => [
            'listener' => \API\V1\Rest\History\HistoryResource::class,
            'route_name' => 'api.rest.history',
            'route_identifier_name' => 'history_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'pet',
                1 => 'veterinary',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\History::class,
            'collection_class' => \API\V1\Rest\History\HistoryCollection::class,
            'service_name' => 'History',
        ],
        'API\\V1\\Rest\\Image\\Controller' => [
            'listener' => \API\V1\Rest\Image\ImageResource::class,
            'route_name' => 'api.rest.image',
            'route_identifier_name' => 'image_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => '20',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Image::class,
            'collection_class' => \API\V1\Rest\Image\ImageCollection::class,
            'service_name' => 'Image',
        ],
        'API\\V1\\Rest\\I18n\\Controller' => [
            'listener' => \API\V1\Rest\I18n\I18nResource::class,
            'route_name' => 'api.rest.i18n',
            'route_identifier_name' => 'i18n_id',
            'collection_name' => 'i18n',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\I18n::class,
            'collection_class' => \API\V1\Rest\I18n\I18nCollection::class,
            'service_name' => 'I18n',
        ],
        'API\\V1\\Rest\\Report\\Controller' => [
            'listener' => \API\V1\Rest\Report\ReportResource::class,
            'route_name' => 'api.rest.report',
            'route_identifier_name' => 'report_id',
            'collection_name' => 'list',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'start',
                1 => 'end',
            ],
            'page_size' => '100',
            'page_size_param' => null,
            'entity_class' => 'API\\V1\\Rest\\Pet',
            'collection_class' => \API\V1\Rest\Report\ReportCollection::class,
            'service_name' => 'Report',
        ],
        'API\\V1\\Rest\\HistoryAction\\Controller' => [
            'listener' => \API\V1\Rest\HistoryAction\HistoryActionResource::class,
            'route_name' => 'api.rest.history-action',
            'route_identifier_name' => 'history_action_id',
            'collection_name' => 'actions',
            'entity_http_methods' => [
                0 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'category',
                1 => 'day',
                2 => 'pet',
                3 => 'history',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => 'API\\V1\\Rest\\Entity\\HistoryAction',
            'collection_class' => \API\V1\Rest\HistoryAction\HistoryActionCollection::class,
            'service_name' => 'HistoryAction',
        ],
        'API\\V1\\Rest\\Promoter\\Controller' => [
            'listener' => \API\V1\Rest\Promoter\PromoterResource::class,
            'route_name' => 'api.rest.promoter',
            'route_identifier_name' => 'promoter_id',
            'collection_name' => 'list',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'search',
                1 => 'order',
            ],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \API\V1\Entity\Promoter::class,
            'collection_class' => \API\V1\Rest\Promoter\PromoterCollection::class,
            'service_name' => 'Promoter',
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'API\\V1\\Rest\\Distributor\\DistributorEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.distributor',
                'route_identifier_name' => 'distributor_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Distributor\DistributorCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.distributor',
                'route_identifier_name' => 'distributor_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Distributor::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.distributor',
                'route_identifier_name' => 'distributor_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\User\\UserEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\User\UserCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\User::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\Clinic\\ClinicEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.clinic',
                'route_identifier_name' => 'clinic_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Clinic\ClinicCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.clinic',
                'route_identifier_name' => 'clinic_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Clinic::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.clinic',
                'route_identifier_name' => 'clinic_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\Employee\\EmployeeEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.employee',
                'route_identifier_name' => 'employee_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Employee\EmployeeCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.employee',
                'route_identifier_name' => 'employee_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Employee::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.employee',
                'route_identifier_name' => 'employee_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\Newsletter\\NewsletterEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.newsletter',
                'route_identifier_name' => 'newsletter_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Newsletter\NewsletterCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.newsletter',
                'route_identifier_name' => 'newsletter_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Newsletter::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.newsletter',
                'route_identifier_name' => 'newsletter_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\Pet\\PetEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.pet',
                'route_identifier_name' => 'pet_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Pet\PetCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.pet',
                'route_identifier_name' => 'pet_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Pet::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.pet',
                'route_identifier_name' => 'pet_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\History\\HistoryEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.history',
                'route_identifier_name' => 'history_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\History\HistoryCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.history',
                'route_identifier_name' => 'history_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\History::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.history',
                'route_identifier_name' => 'history_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\Image\\ImageEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.image',
                'route_identifier_name' => 'image_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Image\ImageCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.image',
                'route_identifier_name' => 'image_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Image::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.image',
                'route_identifier_name' => 'image_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\I18n\\I18nEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.i18n',
                'route_identifier_name' => 'i18n_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\I18n\I18nCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.i18n',
                'route_identifier_name' => 'i18n_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\I18n::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.i18n',
                'route_identifier_name' => 'i18n_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'API\\V1\\Rest\\Report\\ReportEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.report',
                'route_identifier_name' => 'report_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Report\ReportCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.report',
                'route_identifier_name' => 'report_id',
                'is_collection' => true,
            ],
            'API\\V1\\Rest\\Pet' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.report',
                'route_identifier_name' => 'report_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\HistoryAction\\HistoryActionEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.history-action',
                'route_identifier_name' => 'history_action_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\HistoryAction\HistoryActionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.history-action',
                'route_identifier_name' => 'history_action_id',
                'is_collection' => true,
            ],
            'API\\V1\\Rest\\Entity\\HistoryAction' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.history-action',
                'route_identifier_name' => 'history_action_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            'API\\V1\\Rest\\Promoter\\PromoterEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.promoter',
                'route_identifier_name' => 'promoter_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \API\V1\Rest\Promoter\PromoterCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.promoter',
                'route_identifier_name' => 'promoter_id',
                'is_collection' => true,
            ],
            \API\V1\Entity\Promoter::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.promoter',
                'route_identifier_name' => 'promoter_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
        ],
    ],
];

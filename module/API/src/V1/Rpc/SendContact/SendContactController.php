<?php

namespace API\V1\Rpc\SendContact;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * RPC para webhook Stripe
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SendContactController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function sendContactAction() {
        $data = (object) $this->bodyParams();

        $dia = date('d/m/Y H:i:s');
        $text = <<<TEXT
                Data envio: {$dia}<br>
                Nome: {$data->nome}<br>
                E-mail: {$data->email}<br>
                Celular: {$data->phone}<br>
                Mensagem: <br>
                {$data->message}
TEXT;

        $title = 'Novo contato pelo site';
        $subject = 'Novo contato pelo site';

        $vars = json_encode([
            'personalizations' => [
                [
                    'to' => [
                        [
                            'email' => 'yahuchanam@gmail.com',
                            'name' => 'Marcus Borges'
                        ],
                        [
                            'email' => 'luisanderson@inetpet.com',
                            'name' => 'Anderson Luis'
                        ],
                    ],
                    'dynamic_template_data' => [
                        'link' => '',
                        'title' => $title,
                        'button' => '',
                        'text' => $text,
                        'subject' => $subject
                    ]
                ]
            ],
            'from' => [
                'email' => 'support@inetpet.com',
                'name' => 'Chris Matt'
            ],
            'reply_to' => [
                'email' => 'support@inetpet.com',
                'name' => 'Chris Matt'
            ],
            'template_id' => 'd-b7dc266d96cb434eaf18a7c4ac17fb34'
        ]);

        $this->sendEmail($vars);
        return [
            'status' => 'ok'
        ];
    }

}

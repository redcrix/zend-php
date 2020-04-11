<?php

namespace API\V1\Rpc\ForgotPassword;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\User;
use API\V1\Entity\EmailToken;

/**
 * RPC envio de e-mail para resetar a senha
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class ForgotPasswordController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Cria um link com token para redefinir a senha e envia ele para o e-mail 
     * do usuário.
     */
    public function forgotPasswordAction() {
        $data = (object) $this->bodyParams();

        $user = $this->em->getRepository(User::class)
                ->findOneBy(['username' => $data->email]);

        if (!!$user) {
            $token = $this->createToken($user);
            $layout = $this->configLayout($token, $user, $data);
            $this->sendEmail($layout);

            $user->setPasswordReset(true);
            $this->em->persist($user);
            $this->em->flush();
            return [
                'status' => 'ok',
                'msg' => 'sent'
            ];
        }

        return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(428, 'User not found')
        );
    }

    /**
     * Configura as variáveis para o email
     * @param string $token
     * @param User $user
     * @param stdClass $data
     * @return array
     */
    private function configLayout($token, User $user, $data) {
        #URI da aplicação Angular/Front-end
        $uri = $this->config['frontend']['uri'];
        $link = $uri . '/password-reset/' . $token;
        $dicionario = $this->getDicionario($data->lang);
        $text = str_replace('%name%', $user->getName(), $dicionario['reset_password_layout_email_desc']);
        $title = str_replace('%name%', $user->getName(), $dicionario['reset_password_layout_email_title']);
        $subject = str_replace('%name%', $user->getName(), $dicionario['reset_password_title']);

        $vars = json_encode([
            'personalizations' => [
                [
                    'to' => [
                        [
                            'email' => $user->getUsername(),
                            'name' => $user->getName()
                        ]
                    ],
                    'dynamic_template_data' => [
                        'link' => $link,
                        'title' => $title,
                        'button' => $dicionario['reset_password_layout_email_button'],
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

        return $vars;
    }

    /**
     * Gerador de token para redefinição de senha
     * 
     * @param User $user
     * @return string
     */
    private function createToken(User $user) {
        $token = md5(date('Ymdis') . $user->getUsername()) . md5('redefinir-senha') . md5($user->getPassword());

        $emailToken = new EmailToken();
        $emailToken->setDateSend(new \DateTime());
        $emailToken->setEmail($user->getUsername());
        $emailToken->setToken($token);
        $emailToken->setType('redefinir-senha');
        $emailToken->setIsUsed(false);

        $this->em->persist($emailToken);
        $this->em->flush();

        return $token;
    }

}

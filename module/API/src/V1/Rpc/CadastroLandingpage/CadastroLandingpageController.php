<?php

namespace API\V1\Rpc\CadastroLandingpage;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Rest\User\UserResource;
use API\V1\Entity\BusinessManager;
use API\V1\Entity\Clinic;
use API\V1\Entity\Address;

/**
 * RPC para persistir um profissional vindo da landingpage
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class CadastroLandingpageController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    private $ctrl;

    public function cadastroLandingpageAction() {
        $data = (object) $this->bodyParams();

        $data->id = 'novo';
        $data->username = $data->email;
        $this->ctrl = new UserResource($this->em, $this->config);
        $data->usuarioId = 'novo';
        $user = $this->ctrl->getVerifyUser($data, true, 'manager');
        if (!$user) {
            return $this->sendError(200, 'usuarioexiste');
        }

        $address = new Address();
        $address->setAddress('')
                ->setNumber('')
                ->setAddress2('')
                ->setAddress3('')
                ->setCity($data->cidade)
                ->setState($data->estado)
                ->setZipcode('')
                ->setCountry($data->pais);
        $this->em->persist($address);
        $user->setAddress($address);

        $manager = new BusinessManager();
        $user->setBlocked(false)
                ->setDeleted(false)
                ->setEmailConfirmation(false)
                ->setPasswordReset(true)
                ->setPassword('NewUserPassword')
                ->setCreation(new \DateTime())
                ->setRole('manager')
                ->setSession('{"path": ""}')
                ->setUpdate(new \DateTime());
        $manager->setUser($user);

        $user->setDocument('')
                ->setName($data->nome)
                ->setPhone($data->celular);

        $manager = $this->saveClinic($data, $manager);
        $this->sendEmailProfessional($user, $data);

        $this->em->persist($user);
        $this->em->persist($manager);
        $this->em->flush();

        return [
            'status' => 'ok'
        ];
    }

    /**
     * Persiste uma clínica
     * @param stdClass $data
     * @param BusinessManager $manager
     * @return BusinessManager
     */
    private function saveClinic($data, BusinessManager $manager) {
        $clinic = new Clinic();
        $clinic->setCreation(new \DateTime())
                ->setManager($manager);

        $manager->setClinic($clinic);

        $address = new Address();
        $address->setAddress('')
                ->setNumber('')
                ->setAddress2('')
                ->setAddress3('')
                ->setCity($data->cidade)
                ->setState($data->estado)
                ->setZipcode('')
                ->setCountry($data->pais);
        $this->em->persist($address);
        $clinic->setAddress($address);
        $clinic->setName($data->nome)
                ->setPesquisaPet($data->pets)
                ->setPhone($data->celular);

        $this->em->persist($clinic);
        return $manager;
    }

    private function sendEmailProfessional($user, $data) {
        $config = $this->config['frontend']['uri'];
        $link = $config . '/email-confirmation/' . $this->ctrl->createToken($user);

        $dicionario = $this->getDicionario($data->lang);
        $text = str_replace('%name%', $user->getName(), $dicionario['register_user_layout_email_desc']);
        $title = str_replace('%name%', $user->getName(), $dicionario['register_user_layout_email_title']);
        $subject = str_replace('%name%', $user->getName(), $dicionario['register_user_title']);

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
                        'button' => $dicionario['register_password_layout_email_button'],
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

        $this->ctrl->sendEmail($vars);
    }

}

<?php

namespace API\V1\Rpc\PasswordChangeToken;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Crypt\Password\Bcrypt;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use API\V1\Entity\EmailToken;
use API\V1\Entity\User;

/**
 * RPC para atualizar ou cadastrar senha de um usuário
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class PasswordChangeTokenController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Configura senha de um usuário
     */
    public function passwordChangeTokenAction() {
        $data = (object) $this->bodyParams();

        $tipo = false;
        switch ($data->local) {
            case 'password-reset':
                $tipo = 'redefinir-senha';
                break;
            case 'email-confirmation':
                $tipo = 'ativar-email';
                break;
        }

        if (!$tipo) {
            return new ApiProblemResponse(
                    new ApiProblem(401, 'password_change_invalid_token')
            );
        }

        $qb = $this->em->createQueryBuilder();
        $qb->select(['e']);
        $qb->from(EmailToken::class, 'e');
        $qb->where('e.token = :token');
        $qb->andWhere('e.isUsed = 0');
        $qb->andWhere('e.type = :tipo');
        $qb->setParameter('token', $data->token);
        $qb->setParameter('tipo', $tipo);
        $qb->orderBy('e.dateSend', 'DESC');
        $email = $qb->getQuery()->getResult();

        $status = 'error';
        $usuario = null;
        if (count($email) > 0) {
            if ($data->local == 'email-confirmation') {
                if (!$this->checkNovoCadastro($email[0], $data)) {
                    return new ApiProblemResponse(
                            new ApiProblem(401, 'password_change_invalid_token')
                    );
                }
            } else {
                if (!$this->checkResetSenha($email[0], $data)) {
                    return new ApiProblemResponse(
                            new ApiProblem(401, 'password_change_invalid_token')
                    );
                }
            }
            $usuario = $this->mudarSenha($email[0], $data);
            $status = 'ok';
        }

        $acesso = null;
        if ($status === 'ok') {
            $acesso = $this->login($usuario, $data);
            $email[0]->setIsUsed(true)
                    ->setDateUse(new \DateTime());

            $this->em->persist($email[0]);
            $this->em->flush();

            return [
                'acesso' => $acesso
            ];
        }

        return new ApiProblemResponse(
                new ApiProblem(401, 'password_change_invalid_token')
        );
    }

    private function checkResetSenha(EmailToken $emailToken, $data) {
        $user = $this->em->getRepository(User::class)
                ->findOneBy(['username' => $emailToken->getEmail()]);

        return $user->getPasswordReset();
    }

    private function checkNovoCadastro(EmailToken $emailToken, $data) {
        $user = $this->em->getRepository(User::class)
                ->findOneBy(['username' => $emailToken->getEmail()]);

        return $user->getPasswordReset() && !$user->getEmailConfirmation();
    }

    private function mudarSenha(EmailToken $emailToken, $data) {
        $user = $this->em->getRepository(User::class)
                ->findOneBy(['username' => $emailToken->getEmail()]);

        if ($data->local == 'email-confirmation') {
            $user->setEmailConfirmation(true)
                    ->setPasswordReset(false);
        }

        # Criptografia da senha
        $crypt = new Bcrypt();
        $senha = $crypt->create($data->password);

        $user->setPassword($senha)
                ->setUpdate(new \DateTime());

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    private function login(User $cliente, $data) {
        $vars = json_encode([
            'username' => $cliente->getUsername(),
            'password' => $data->password
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['api-externo'] . '/login-client');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        $server_output = curl_exec($ch);
        curl_close($ch);
        return json_decode($server_output);
    }

}

<?php

namespace API\V1\Util\Comum;

use Doctrine\ORM\EntityManager;
use API\V1\Util\Log\Logger;
use API\V1\Util\Log\LogModel;
use API\V1\Entity\User;
use API\V1\Entity\Address;
use API\V1\Entity\Image;
use API\V1\Entity\Pet;
use API\V1\Entity\History;
use API\V1\Entity\Veterinary;
use API\V1\Entity\I18n;
use ZF\MvcAuth\Identity\AuthenticatedIdentity;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

/**
 * Trait com metodos e propriedades úteis para todos os serviços
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 */
trait ConstructorUtils {

    /**
     * Gerenciador de entidades (ORM)
     * 
     * @var EntityManager 
     */
    protected $em;

    /**
     * Usuario logado
     * 
     * @var User 
     */
    protected $user;

    /**
     * URI da API
     * 
     * @var string 
     */
    protected $api;

    /**
     * Configurações da aplicação
     * 
     * @var string 
     */
    protected $config;

    /**
     * Dicionário de palavras por idiomas
     * @var array 
     */
    private $dicionario;

    /**
     * Construtor padrão utilizados em todos os serviços RESTs e RPCs
     * @param EntityManager $doctrine
     * @param array $config
     */
    public function __construct(EntityManager $doctrine, $config = []) {
        $this->api = 'https://api.inetpet.com';
        if ($_SERVER['SERVER_NAME'] === 'inetpet') {
            $this->api = 'http://inetpet';
        }
        $this->em = $doctrine;
        $this->config = $config;
    }

    /**
     * Envia mensagem de erro para RPCs
     * @param integer $code
     * @param string $message
     * @return ApiProblemResponse
     */
    public function sendError($code, $message) {
        return new ApiProblemResponse(
                new ApiProblem($code, $message)
        );
    }

    /**
     * Verifica se um usuário tem permissão para executar um método
     * @param array $permitidos
     * @return boolean
     */
    public function isAutorized($permitidos) {
        $this->getUser();
        return in_array($this->user->getRole(), $permitidos);
    }

    /**
     * Recupera um dicionário de um idioma
     * @param string $lang
     * @return array
     */
    public function getDicionario($lang = false) {

        if (isset($this->dicionario)) {
            return $this->dicionario;
        }

        if (!$lang) {
            $headers = [];
            foreach (getallheaders() as $key => $value) {
                $headers[$key] = $value;
            }

            $lang = $headers['Lang'];
        }

        $dicionario = $this->em->createQueryBuilder()
                ->select(['i'])
                ->from(I18n::class, 'i')
                ->where('i.lang = :lang')
                ->setParameter('lang', $lang)
                ->getQuery()
                ->getResult();

        $retorno = [];

        foreach ($dicionario as $palavra) {
            $retorno[$palavra->getTitle()] = $palavra->getValue();
        }

        $this->dicionario = $retorno;
        return $retorno;
    }

    /**
     * Envia um email por SendGrid
     * @param array $vars
     * @return json
     */
    public function sendEmail($vars) {
        $ch = \curl_init();
        \curl_setopt($ch, \CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
        \curl_setopt($ch, \CURLOPT_POST, 1);
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $vars);
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->config['sendgrid-api']
        ));
        $server_output = \curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    /**
     * Recupera um usuário logado
     * 
     * @return boolean | User
     */
    protected function getUser() {
        $identity = $this->getIdentity();
        if ($identity instanceof AuthenticatedIdentity) {
            $oauth2Identity = $identity->getAuthenticationIdentity();
            if ($oauth2Identity) {
                $this->user = $this->em
                        ->getRepository(User::class)
                        ->findOneBy(['username' => $oauth2Identity['user_id']]);
                return $this->user;
            }
        }
        return false;
    }

    /**
     * Gera log de atividade
     * 
     * @param Usuario $cliente
     * @param \DateTime $dia
     * @param stdClass $data
     * @param array $resposta
     */
    protected function createLog($acao, $cliente, \DateTime $dia, $data, $resposta, $erro) {
        Logger::createLog($this->em, new LogModel([
            'acao' => $acao,
            'usuario' => $cliente,
            'dia' => $dia,
            'enviado' => $data,
            'resposta' => $resposta,
            'erro' => $erro,
        ]));
    }

    /**
     * Recupera a URI do front-end
     * 
     * @return string
     */
    protected function getFrontEndURI() {
        return $_SERVER['HTTP_HOST'] === 'inetpet' ?
                $this->config['frontend']['uri-dev'] :
                $this->config['frontend']['uri'];
    }

    /**
     * Cria um endereço
     * @param stdClass $data
     * @return Address | null
     */
    private function createAddress($data) {
        $address = null;
        if (isset($data->address)) {
            $address = new Address();
            $address->setAddress($data->address->address)
                    ->setNumber($data->address->number)
                    ->setCity($data->address->city)
                    ->setState($data->address->state)
                    ->setCountry($data->address->country);

            $this->em->persist($address);
        }
        return $address;
    }

    /**
     * Cria uma imagem
     * @param type $data
     * @return Image
     */
    private function createImage($data) {
        $image = null;
        if (isset($data->photo)) {
            $image = new Image();
            $image->setMime($data->mime);
        }
        return $image;
    }

    /**
     * Cria um usuário
     * @param stdClass $data
     */
    protected function createUser($data): User {
        $user = new User();
        $user->setName($data->name)
                ->setUsername($data->username)
                ->setAddress($this->createAddress($data))
                ->setPhoto($photo)
                ->setDocument($data->document)
                ->setPhone($data->phone)
                ->setPassword('newuser')
                ->setRole('')
                ->setSession('{}')
                ->setPasswordReset(true)
                ->setEmailConfirmation(false)
                ->setDeleted(false)
                ->setBlocked(false)
                ->setCreation(new \DateTime())
                ->setUpdate(new \DateTime());
    }

    /**
     * Retorna QueryBuilder para Usuários
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getUserQueryBuilder() {
        $qb = $this->em->createQueryBuilder();
        $qb->select('u', 'f', 'a');
        $qb->from(User::class, 'u');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.address', 'a');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->setParameter('role', $this->role);
        return $qb;
    }

    /**
     * Recupera um usuário usando ID
     * @param string $id
     * @return User | null
     */
    private function getUserById($id) {
        $qb = $this->getUserQueryBuilder();
        $qb->andWhere('u.id = :id');
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Recupera um usuário usando Username
     * @param string $username
     * @return User | null
     */
    protected function getUserByUsername($username) {
        $qb = $this->getUserQueryBuilder();
        $qb->andWhere('u.username = :username');
        $qb->setParameter('username', $username);
        return $qb->getQuery()->getOneOrNullResult();
    }

    protected function getOpenHistory($pet) {
        $session = json_decode($this->user->getSession());
        $entity = History::class;
        $dql = <<<DQL
                SELECT 
                    h
                FROM {$entity} h
                LEFT JOIN h.pet p
                LEFT JOIN h.clinic c
                WHERE p.id = :pet
                AND h.release IS NULL
                AND c.id = :clinic
DQL;

        return $this->em->createQuery($dql)
                        ->setParameter('pet', $pet)
                        ->setParameter('clinic', $session->clinica->id)
                        ->getSingleResult();
    }

    protected function getVeterinary() {
        $entity = Veterinary::class;
        $dql = <<<DQL
                SELECT 
                    v
                FROM {$entity} v
                JOIN v.user u
                WHERE u.id = :id
DQL;

        return $this->em->createQuery($dql)
                        ->setParameter('id', $this->user->getId())
                        ->getSingleResult();
    }

}

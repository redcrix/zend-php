<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 * @ORM\Table(name="oauth_users")
 * @ORM\Entity
 */
class User {

    /**
     * ID do usuário
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * E-mail do usuário
     * @var string     
     * @ORM\Column(name="username", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $username;

    /**
     * Senha do usuário
     * @var string|null
     * @ORM\Column(name="password", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $password;

    /**
     * Nome completo do usuário
     * @var string|null
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * Documento fiscal do usuário
     * @var string|null
     * @ORM\Column(name="document", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $document;

    /**
     * Nome completo do usuário
     * @var string|null
     * @ORM\Column(name="phone", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $phone;

    /**
     * Perfil do usuário
     * Valores possíveis: admin, owner, distributor, manager e employee
     * @var string
     * @ORM\Column(name="role", type="string", length=18, nullable=false)
     */
    private $role;

    /**
     * Data de cadastro do usuário
     * @var \DateTime
     * @ORM\Column(name="creation_data", type="datetime", nullable=true)
     */
    private $creation;

    /**
     * Data da última atualização de dados do usuário
     * @var \DateTime
     * @ORM\Column(name="update_data", type="datetime", nullable=true)
     */
    private $update;

    /**
     * Flag que controla se usuário está ativado (e-mail ativo)
     * @var boolean
     * @ORM\Column(name="email_confirmation", type="boolean")
     */
    private $emailConfirmation;

    /**
     * Flag que controla se usuário irá resetar a senha
     * @var boolean
     * @ORM\Column(name="password_reset", type="boolean")
     */
    private $passwordReset;

    /**
     * Flag que controla se usuário está deletado
     * @var boolean
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    /**
     * Flag que controla se usuário está bloqueado
     * @var boolean
     * @ORM\Column(name="blocked", type="boolean")
     */
    private $blocked;

    /**
     * Armazena dados de sessão de um usuário como preferências, última tela navegada e etc...
     * @var string
     * @ORM\Column(name="session", type="text", nullable=true)
     */
    private $session;

    /**
     * Foto do usuário
     * @var Image
     * @ORM\OneToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     */
    private $photo;

    /**
     * Endereco do usuário
     * @var Address
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    /**
     * Informações de veterinário
     * @var Veterinary
     * @ORM\OneToOne(targetEntity="Veterinary", inversedBy="user")
     * @ORM\JoinColumn(name="veterinary_id", referencedColumnName="id")
     */
    private $veterinary;

    public function __construct() {
        
    }

    /**
     * Retorna resumo dos dados do usuário
     * 
     * @return array
     */
    public function getShortData() {
        $dados = new \stdClass();
        $dados->id = $this->id;
        $dados->name = $this->name;
        $dados->username = $this->username;
        $dados->role = $this->role;
        if (isset($this->session)) {
            $dados->session = \json_decode($this->session);
        }
        if (isset($this->photo)) {
            $dados->photo = [
                'id' => $this->photo->getId(),
                'mime' => $this->photo->getMime()
            ];
        }
        return (array) $dados;
    }

    ######### Auxiliares #########

    /**
     * Verifica se um usuário é admin
     * @return boolean
     */
    public function isAdmin() {
        return $this->role === 'admin';
    }

    /**
     * Verifica se um usuário é distribuidor
     * @return boolean
     */
    public function isDistributor() {
        return $this->role === 'distributor';
    }

    /**
     * Verifica se um usuário é um gerente de clínica
     * @return boolean
     */
    public function isManager() {
        return $this->role === 'manager';
    }

    /**
     * Verifica se um usuário é um funcionário de clínica
     * @return boolean
     */
    public function isEmployee() {
        return $this->role === 'employee';
    }

    /**
     * Verifica se um usuário é um dono de pet
     * @return boolean
     */
    public function isOwner() {
        return $this->role === 'owner';
    }

    /**
     * Verifica se um usuário é um dono de pet
     * @return boolean
     */
    public function isVeterinary() {
        return isset($this->veterinary);
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getDocument() {
        return $this->document;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getRole() {
        return $this->role;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function getUpdate() {
        return $this->update;
    }

    public function getEmailConfirmation() {
        return $this->emailConfirmation;
    }

    public function getPasswordReset() {
        return $this->passwordReset;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getBlocked() {
        return $this->blocked;
    }

    public function getSession() {
        return $this->session;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getVeterinary() {
        return $this->veterinary;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDocument($document) {
        $this->document = $document;
        return $this;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    public function setUpdate($update) {
        $this->update = $update;
        return $this;
    }

    public function setEmailConfirmation($emailConfirmation) {
        $this->emailConfirmation = $emailConfirmation;
        return $this;
    }

    public function setPasswordReset($passwordReset) {
        $this->passwordReset = $passwordReset;
        return $this;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }

    public function setBlocked($blocked) {
        $this->blocked = $blocked;
        return $this;
    }

    public function setSession($session) {
        $this->session = $session;
        return $this;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setVeterinary($veterinary) {
        $this->veterinary = $veterinary;
        return $this;
    }

}

<?php

namespace DoctrineORMModule\Proxy\__CG__\API\V1\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \API\V1\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'username', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'password', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'name', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'document', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'phone', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'role', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'creation', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'update', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'emailConfirmation', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'passwordReset', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'deleted', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'blocked', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'session', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'photo', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'address', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'veterinary'];
        }

        return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'username', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'password', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'name', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'document', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'phone', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'role', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'creation', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'update', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'emailConfirmation', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'passwordReset', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'deleted', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'blocked', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'session', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'photo', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'address', '' . "\0" . 'API\\V1\\Entity\\User' . "\0" . 'veterinary'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getShortData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getShortData', []);

        return parent::getShortData();
    }

    /**
     * {@inheritDoc}
     */
    public function isAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAdmin', []);

        return parent::isAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function isDistributor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isDistributor', []);

        return parent::isDistributor();
    }

    /**
     * {@inheritDoc}
     */
    public function isManager()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isManager', []);

        return parent::isManager();
    }

    /**
     * {@inheritDoc}
     */
    public function isEmployee()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isEmployee', []);

        return parent::isEmployee();
    }

    /**
     * {@inheritDoc}
     */
    public function isOwner()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isOwner', []);

        return parent::isOwner();
    }

    /**
     * {@inheritDoc}
     */
    public function isVeterinary()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isVeterinary', []);

        return parent::isVeterinary();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getDocument()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDocument', []);

        return parent::getDocument();
    }

    /**
     * {@inheritDoc}
     */
    public function getPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhone', []);

        return parent::getPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function getRole()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRole', []);

        return parent::getRole();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreation', []);

        return parent::getCreation();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdate', []);

        return parent::getUpdate();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailConfirmation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailConfirmation', []);

        return parent::getEmailConfirmation();
    }

    /**
     * {@inheritDoc}
     */
    public function getPasswordReset()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPasswordReset', []);

        return parent::getPasswordReset();
    }

    /**
     * {@inheritDoc}
     */
    public function getDeleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeleted', []);

        return parent::getDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function getBlocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBlocked', []);

        return parent::getBlocked();
    }

    /**
     * {@inheritDoc}
     */
    public function getSession()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSession', []);

        return parent::getSession();
    }

    /**
     * {@inheritDoc}
     */
    public function getPhoto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhoto', []);

        return parent::getPhoto();
    }

    /**
     * {@inheritDoc}
     */
    public function getAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddress', []);

        return parent::getAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function getVeterinary()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVeterinary', []);

        return parent::getVeterinary();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', [$username]);

        return parent::setUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setDocument($document)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDocument', [$document]);

        return parent::setDocument($document);
    }

    /**
     * {@inheritDoc}
     */
    public function setPhone($phone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhone', [$phone]);

        return parent::setPhone($phone);
    }

    /**
     * {@inheritDoc}
     */
    public function setRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRole', [$role]);

        return parent::setRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreation($creation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreation', [$creation]);

        return parent::setCreation($creation);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdate($update)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdate', [$update]);

        return parent::setUpdate($update);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailConfirmation($emailConfirmation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailConfirmation', [$emailConfirmation]);

        return parent::setEmailConfirmation($emailConfirmation);
    }

    /**
     * {@inheritDoc}
     */
    public function setPasswordReset($passwordReset)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPasswordReset', [$passwordReset]);

        return parent::setPasswordReset($passwordReset);
    }

    /**
     * {@inheritDoc}
     */
    public function setDeleted($deleted)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeleted', [$deleted]);

        return parent::setDeleted($deleted);
    }

    /**
     * {@inheritDoc}
     */
    public function setBlocked($blocked)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBlocked', [$blocked]);

        return parent::setBlocked($blocked);
    }

    /**
     * {@inheritDoc}
     */
    public function setSession($session)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSession', [$session]);

        return parent::setSession($session);
    }

    /**
     * {@inheritDoc}
     */
    public function setPhoto($photo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhoto', [$photo]);

        return parent::setPhoto($photo);
    }

    /**
     * {@inheritDoc}
     */
    public function setAddress($address)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddress', [$address]);

        return parent::setAddress($address);
    }

    /**
     * {@inheritDoc}
     */
    public function setVeterinary($veterinary)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVeterinary', [$veterinary]);

        return parent::setVeterinary($veterinary);
    }

}
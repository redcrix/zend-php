<?php

namespace DoctrineORMModule\Proxy\__CG__\API\V1\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class History extends \API\V1\Entity\History implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'clinic', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'pet', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'actions', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'diagnosis', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'therapeuticPlan', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'reason', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'anamnesics', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'presumptiveDiagnosis', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'impressionDiagnosis', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'creation', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'release', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'userCreation', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'userRelease', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'nursery'];
        }

        return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'clinic', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'pet', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'actions', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'diagnosis', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'therapeuticPlan', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'reason', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'anamnesics', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'presumptiveDiagnosis', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'impressionDiagnosis', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'creation', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'release', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'userCreation', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'userRelease', '' . "\0" . 'API\\V1\\Entity\\History' . "\0" . 'nursery'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (History $proxy) {
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
    public function getClinic()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClinic', []);

        return parent::getClinic();
    }

    /**
     * {@inheritDoc}
     */
    public function getPet()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPet', []);

        return parent::getPet();
    }

    /**
     * {@inheritDoc}
     */
    public function getActions()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getActions', []);

        return parent::getActions();
    }

    /**
     * {@inheritDoc}
     */
    public function getDiagnosis()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiagnosis', []);

        return parent::getDiagnosis();
    }

    /**
     * {@inheritDoc}
     */
    public function getTherapeuticPlan()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTherapeuticPlan', []);

        return parent::getTherapeuticPlan();
    }

    /**
     * {@inheritDoc}
     */
    public function getReason()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReason', []);

        return parent::getReason();
    }

    /**
     * {@inheritDoc}
     */
    public function getAnamnesics()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAnamnesics', []);

        return parent::getAnamnesics();
    }

    /**
     * {@inheritDoc}
     */
    public function getPresumptiveDiagnosis()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPresumptiveDiagnosis', []);

        return parent::getPresumptiveDiagnosis();
    }

    /**
     * {@inheritDoc}
     */
    public function getImpressionDiagnosis()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImpressionDiagnosis', []);

        return parent::getImpressionDiagnosis();
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
    public function getRelease()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRelease', []);

        return parent::getRelease();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserCreation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserCreation', []);

        return parent::getUserCreation();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserRelease()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserRelease', []);

        return parent::getUserRelease();
    }

    /**
     * {@inheritDoc}
     */
    public function getNursery()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNursery', []);

        return parent::getNursery();
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
    public function setClinic($clinic)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setClinic', [$clinic]);

        return parent::setClinic($clinic);
    }

    /**
     * {@inheritDoc}
     */
    public function setPet($pet)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPet', [$pet]);

        return parent::setPet($pet);
    }

    /**
     * {@inheritDoc}
     */
    public function setActions($actions)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setActions', [$actions]);

        return parent::setActions($actions);
    }

    /**
     * {@inheritDoc}
     */
    public function setDiagnosis($diagnosis)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiagnosis', [$diagnosis]);

        return parent::setDiagnosis($diagnosis);
    }

    /**
     * {@inheritDoc}
     */
    public function setTherapeuticPlan($therapeuticPlan)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTherapeuticPlan', [$therapeuticPlan]);

        return parent::setTherapeuticPlan($therapeuticPlan);
    }

    /**
     * {@inheritDoc}
     */
    public function setReason($reason)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReason', [$reason]);

        return parent::setReason($reason);
    }

    /**
     * {@inheritDoc}
     */
    public function setAnamnesics($anamnesics)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAnamnesics', [$anamnesics]);

        return parent::setAnamnesics($anamnesics);
    }

    /**
     * {@inheritDoc}
     */
    public function setPresumptiveDiagnosis($presumptiveDiagnosis)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPresumptiveDiagnosis', [$presumptiveDiagnosis]);

        return parent::setPresumptiveDiagnosis($presumptiveDiagnosis);
    }

    /**
     * {@inheritDoc}
     */
    public function setImpressionDiagnosis($impressionDiagnosis)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setImpressionDiagnosis', [$impressionDiagnosis]);

        return parent::setImpressionDiagnosis($impressionDiagnosis);
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
    public function setRelease($release)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRelease', [$release]);

        return parent::setRelease($release);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserCreation($userCreation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserCreation', [$userCreation]);

        return parent::setUserCreation($userCreation);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserRelease($userRelease)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserRelease', [$userRelease]);

        return parent::setUserRelease($userRelease);
    }

    /**
     * {@inheritDoc}
     */
    public function setNursery($nursery)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNursery', [$nursery]);

        return parent::setNursery($nursery);
    }

}

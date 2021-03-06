<?php

namespace DoctrineORMModule\Proxy\__CG__\API\V1\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class PetRecord extends \API\V1\Entity\PetRecord implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'groomings', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'histories', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'historiesPdf', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'vitalSigns', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'vaccines', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'desparasitations', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'feeding', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'reproductiveState', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'previousDiseases', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'surgeries', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'allergies', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'familyBackground', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'habitatt'];
        }

        return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'groomings', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'histories', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'historiesPdf', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'vitalSigns', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'vaccines', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'desparasitations', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'feeding', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'reproductiveState', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'previousDiseases', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'surgeries', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'allergies', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'familyBackground', '' . "\0" . 'API\\V1\\Entity\\PetRecord' . "\0" . 'habitatt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (PetRecord $proxy) {
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
    public function getHistories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHistories', []);

        return parent::getHistories();
    }

    /**
     * {@inheritDoc}
     */
    public function getVitalSigns()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVitalSigns', []);

        return parent::getVitalSigns();
    }

    /**
     * {@inheritDoc}
     */
    public function getVaccines()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVaccines', []);

        return parent::getVaccines();
    }

    /**
     * {@inheritDoc}
     */
    public function getDesparasitations()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDesparasitations', []);

        return parent::getDesparasitations();
    }

    /**
     * {@inheritDoc}
     */
    public function getFeeding()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFeeding', []);

        return parent::getFeeding();
    }

    /**
     * {@inheritDoc}
     */
    public function getReproductiveState()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReproductiveState', []);

        return parent::getReproductiveState();
    }

    /**
     * {@inheritDoc}
     */
    public function getPreviousDiseases()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPreviousDiseases', []);

        return parent::getPreviousDiseases();
    }

    /**
     * {@inheritDoc}
     */
    public function getSurgeries()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSurgeries', []);

        return parent::getSurgeries();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllergies()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllergies', []);

        return parent::getAllergies();
    }

    /**
     * {@inheritDoc}
     */
    public function getFamilyBackground()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFamilyBackground', []);

        return parent::getFamilyBackground();
    }

    /**
     * {@inheritDoc}
     */
    public function getHabitatt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHabitatt', []);

        return parent::getHabitatt();
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
    public function setHistories($histories)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHistories', [$histories]);

        return parent::setHistories($histories);
    }

    /**
     * {@inheritDoc}
     */
    public function setVitalSigns($vitalSigns)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVitalSigns', [$vitalSigns]);

        return parent::setVitalSigns($vitalSigns);
    }

    /**
     * {@inheritDoc}
     */
    public function setVaccines($vaccines)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVaccines', [$vaccines]);

        return parent::setVaccines($vaccines);
    }

    /**
     * {@inheritDoc}
     */
    public function setDesparasitations($desparasitations)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDesparasitations', [$desparasitations]);

        return parent::setDesparasitations($desparasitations);
    }

    /**
     * {@inheritDoc}
     */
    public function setFeeding($feeding)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFeeding', [$feeding]);

        return parent::setFeeding($feeding);
    }

    /**
     * {@inheritDoc}
     */
    public function setReproductiveState($reproductiveState)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReproductiveState', [$reproductiveState]);

        return parent::setReproductiveState($reproductiveState);
    }

    /**
     * {@inheritDoc}
     */
    public function setPreviousDiseases($previousDiseases)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPreviousDiseases', [$previousDiseases]);

        return parent::setPreviousDiseases($previousDiseases);
    }

    /**
     * {@inheritDoc}
     */
    public function setSurgeries($surgeries)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSurgeries', [$surgeries]);

        return parent::setSurgeries($surgeries);
    }

    /**
     * {@inheritDoc}
     */
    public function setAllergies($allergies)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllergies', [$allergies]);

        return parent::setAllergies($allergies);
    }

    /**
     * {@inheritDoc}
     */
    public function setFamilyBackground($familyBackground)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFamilyBackground', [$familyBackground]);

        return parent::setFamilyBackground($familyBackground);
    }

    /**
     * {@inheritDoc}
     */
    public function setHabitatt($habitatt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHabitatt', [$habitatt]);

        return parent::setHabitatt($habitatt);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroomings()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroomings', []);

        return parent::getGroomings();
    }

    /**
     * {@inheritDoc}
     */
    public function getHistoriesPdf()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHistoriesPdf', []);

        return parent::getHistoriesPdf();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroomings($groomings)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroomings', [$groomings]);

        return parent::setGroomings($groomings);
    }

    /**
     * {@inheritDoc}
     */
    public function setHistoriesPdf($historiesPdf)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHistoriesPdf', [$historiesPdf]);

        return parent::setHistoriesPdf($historiesPdf);
    }

}

<?php

namespace DoctrineORMModule\Proxy\__CG__\API\V1\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ClinicConfig extends \API\V1\Entity\ClinicConfig implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'crt', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'hr', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'rf', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'pulse', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'temperature', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'weight', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'currency', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'thousandsSep', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'decimalSep'];
        }

        return ['__isInitialized__', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'id', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'crt', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'hr', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'rf', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'pulse', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'temperature', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'weight', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'currency', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'thousandsSep', '' . "\0" . 'API\\V1\\Entity\\ClinicConfig' . "\0" . 'decimalSep'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ClinicConfig $proxy) {
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
    public function getData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getData', []);

        return parent::getData();
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
    public function getCrt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCrt', []);

        return parent::getCrt();
    }

    /**
     * {@inheritDoc}
     */
    public function getHr()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHr', []);

        return parent::getHr();
    }

    /**
     * {@inheritDoc}
     */
    public function getRf()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRf', []);

        return parent::getRf();
    }

    /**
     * {@inheritDoc}
     */
    public function getPulse()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPulse', []);

        return parent::getPulse();
    }

    /**
     * {@inheritDoc}
     */
    public function getTemperature()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTemperature', []);

        return parent::getTemperature();
    }

    /**
     * {@inheritDoc}
     */
    public function getWeight()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWeight', []);

        return parent::getWeight();
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurrency', []);

        return parent::getCurrency();
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
    public function setCrt($crt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCrt', [$crt]);

        return parent::setCrt($crt);
    }

    /**
     * {@inheritDoc}
     */
    public function setHr($hr)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHr', [$hr]);

        return parent::setHr($hr);
    }

    /**
     * {@inheritDoc}
     */
    public function setRf($rf)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRf', [$rf]);

        return parent::setRf($rf);
    }

    /**
     * {@inheritDoc}
     */
    public function setPulse($pulse)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPulse', [$pulse]);

        return parent::setPulse($pulse);
    }

    /**
     * {@inheritDoc}
     */
    public function setTemperature($temperature)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTemperature', [$temperature]);

        return parent::setTemperature($temperature);
    }

    /**
     * {@inheritDoc}
     */
    public function setWeight($weight)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWeight', [$weight]);

        return parent::setWeight($weight);
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrency($currency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrency', [$currency]);

        return parent::setCurrency($currency);
    }

}

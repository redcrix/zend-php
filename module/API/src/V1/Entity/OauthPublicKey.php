<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthPublicKey
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 * @ORM\Table(name="oauth_public_keys")
 * @ORM\Entity
 */
class OauthPublicKey {

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=50, precision=0, scale=0, nullable=false, unique=true)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="public_key", type="text")
     */
    private $publicKey;

    /**
     * @var string
     *
     * @ORM\Column(name="private_key", type="text")
     */
    private $privateKey;

    /**
     * @var string
     *
     * @ORM\Column(name="encryption_algorithm", type="string", length=10)
     */
    private $encryption;
    
    public function __construct() {
        
    }

}

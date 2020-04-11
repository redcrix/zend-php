<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthAccessTokens
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 * @ORM\Table(name="oauth_access_tokens")
 * @ORM\Entity
 */
class OauthAccessTokens
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="access_token", type="text", length=800, precision=0, scale=0, nullable=false)
     */
    private $accessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $clientId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_id", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime", precision=0, scale=0, nullable=false, options={"default"="CURRENT_TIMESTAMP"}, unique=false)
     */
    private $expires = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="scope", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $scope;


    /**
     * Get accessToken.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set clientId.
     *
     * @param string $clientId
     *
     * @return OauthAccessTokens
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set userId.
     *
     * @param string|null $userId
     *
     * @return OauthAccessTokens
     */
    public function setUserId($userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return string|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set expires.
     *
     * @param \DateTime $expires
     *
     * @return OauthAccessTokens
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires.
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set scope.
     *
     * @param string|null $scope
     *
     * @return OauthAccessTokens
     */
    public function setScope($scope = null)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope.
     *
     * @return string|null
     */
    public function getScope()
    {
        return $this->scope;
    }
}

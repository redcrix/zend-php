<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthRefreshTokens
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 * @ORM\Table(name="oauth_refresh_tokens")
 * @ORM\Entity
 */
class OauthRefreshTokens
{
    /**
     * @var string
     *
     * @ORM\Column(name="refresh_token", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refreshToken;

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
     * Get refreshToken.
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set clientId.
     *
     * @param string $clientId
     *
     * @return OauthRefreshTokens
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
     * @return OauthRefreshTokens
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
     * @return OauthRefreshTokens
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
     * @return OauthRefreshTokens
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

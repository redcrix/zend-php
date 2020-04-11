<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthAuthorizationCodes
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 * @ORM\Table(name="oauth_authorization_codes")
 * @ORM\Entity
 */
class OauthAuthorizationCodes
{
    /**
     * @var string
     *
     * @ORM\Column(name="authorization_code", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $authorizationCode;

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
     * @var string|null
     *
     * @ORM\Column(name="redirect_uri", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $redirectUri;

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
     * @var string|null
     *
     * @ORM\Column(name="id_token", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $idToken;


    /**
     * Get authorizationCode.
     *
     * @return string
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Set clientId.
     *
     * @param string $clientId
     *
     * @return OauthAuthorizationCodes
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
     * @return OauthAuthorizationCodes
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
     * Set redirectUri.
     *
     * @param string|null $redirectUri
     *
     * @return OauthAuthorizationCodes
     */
    public function setRedirectUri($redirectUri = null)
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }

    /**
     * Get redirectUri.
     *
     * @return string|null
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Set expires.
     *
     * @param \DateTime $expires
     *
     * @return OauthAuthorizationCodes
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
     * @return OauthAuthorizationCodes
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

    /**
     * Set idToken.
     *
     * @param string|null $idToken
     *
     * @return OauthAuthorizationCodes
     */
    public function setIdToken($idToken = null)
    {
        $this->idToken = $idToken;

        return $this;
    }

    /**
     * Get idToken.
     *
     * @return string|null
     */
    public function getIdToken()
    {
        return $this->idToken;
    }
}

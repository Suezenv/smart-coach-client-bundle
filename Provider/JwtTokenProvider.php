<?php

namespace Suez\Bundle\JwtBundle\Provider;

use Suez\Bundle\JwtBundle\Client\JwtClient;

/**
 * JwtTokenProvider
 */
class JwtTokenProvider
{
    /**
     * @var JwtClient
     */
    private $jwtClient;

    /**
     * @param JwtClient $jwtClient
     */
    public function __construct(JwtClient $jwtClient)
    {
        $this->jwtClient = $jwtClient;
    }

    /**
     * @param string    $servicePoint
     * @param \DateTime $contractedAt
     *
     * @return string
     */
    public function getJwtToken($servicePoint, \DateTime $contractedAt)
    {
        $loginResponse = $this->jwtClient->login();
        $jwtResponse = json_decode($loginResponse->body, true);

        return $jwtResponse['token'];
    }
}

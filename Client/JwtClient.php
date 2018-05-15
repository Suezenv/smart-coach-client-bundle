<?php

namespace Suez\Bundle\SmartCoachClientBundle\Client;

use Suez\Bundle\SmartCoachClientBundle\Exception\JwtClientException;

/**
 * JwtClient
 */
class JwtClient
{
    /**
     * @param array $jwtConfig
     */
    public function __construct(array $jwtConfig)
    {
        $this->jwtConfig = $jwtConfig;
    }

    /**
     * @param string    $servicePoint
     * @param \DateTime $contractedAt
     *
     * @return string
     * 
     * @throws JwtClientException
     */
    public function getJwtToken($servicePoint, \DateTime $contractedAt)
    {
        $loginResponse = $this->login($servicePoint, $contractedAt);
        $jwtData = json_decode($loginResponse->body, true);

        if ($jwtData || !isset($jwtData['token'])) {
            throw new JwtClientException('Cannot retrieve `token` from response');
        }

        return $jwtData['token'];
    }

    /**
     * @param string   $servicePoint
     * @param DateTime $contractedAt
     *
     * @return Requests_Response
     */
    private function login($servicePoint, \DateTime $contractedAt)
    {
        $body = json_encode(['servicePoint' => $servicePoint, 'contractedAt' => $contractedAt]);
        $headers = ['apikey' => $this->jwtConfig['apiKey']];
        $request = \Requests::post($this->jwtConfig['url'], $headers, $body);
        $request->throw_for_status();

        return $request;
    }
}

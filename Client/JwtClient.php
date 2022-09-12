<?php

namespace Suez\Bundle\SmartCoachClientBundle\Client;

use Suez\Bundle\SmartCoachClientBundle\Exception\JwtClientException;

class JwtClient
{
    /**
     * @var array
     */
    private $jwtConfig;

    public function __construct(array $jwtConfig)
    {
        $this->jwtConfig = $jwtConfig;
    }

    /**
     * @throws JwtClientException
     */
    public function getJwtToken(string $servicePoint, \DateTime $contractedAt): string
    {
        $loginResponse = $this->login($servicePoint, $contractedAt);
        $jwtData = json_decode($loginResponse->body, true);

        if (!$jwtData || !isset($jwtData['token'])) {
            throw new JwtClientException('Cannot retrieve `token` from response');
        }

        return $jwtData['token'];
    }

    private function login(string $servicePoint, \DateTime $contractedAt): \Requests_Response
    {
        $data = json_encode(['servicePoint' => $servicePoint, 'date' => $contractedAt->format('Y-m-d')]);
        $headers = ['apikey' => $this->jwtConfig['api_key'], 'Content-Type' => 'application/json'];
        $request = \Requests::post($this->jwtConfig['url'], $headers, $data);
        $request->throw_for_status();

        return $request;
    }
}

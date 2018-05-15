<?php

namespace Suez\Bundle\JwtBundle\Client;

/**
 * JwtClient
 */
class JwtClient
{
    /**
     * @param string $url
     * @param string $apiKey
     */
    public function __construct($url, $apiKey)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string   $servicePoint
     * @param DateTime $contractedAt
     *
     * @return Requests_Response
     */
    public function login($servicePoint, \DateTime $contractedAt)
    {
        $body = json_encode(['servicePoint' => $servicePoint, 'contractedAt' => $contractedAt]);
        $headers = ['apikey' => $this->apiKey];
        $request = \Requests::post($this->url, $headers, $body);
        $request->throw_for_status();

        return $request;
    }
}

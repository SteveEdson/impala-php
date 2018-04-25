<?php

namespace Impala;

use Impala\ApiInterface;
use GuzzleHttp\Client;

/**
 * Handles connection to Impala API.
 */
class Api implements ApiInterface
{
    const USER_AGENT = 'impala-php';

    /**
     * Key to authenticate into Impala API.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Client to make HTTP requests.
     *
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Initializes the object setting its properties.
     *
     * @param string $apiKey Key to authenticate into Impala API.
     */
    public function __construct(string $apiKey, Client $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    /**
     * Makes a request to Impala API.
     *
     * @param string $method    The HTTP method to use.
     * @param string $url       The endpoint of the API to call.
     * @param array  $options   Options to pass in the request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function makeRequest(string $method, string $url, array $options = [])
    {
        try {
            $response = $this->client->request(
                $method,
                $url,
                array_merge($options,[
                    'headers' => [
                        'User-Agent' => self::USER_AGENT,
                        'Authorization' => 'Bearer ' . $this->apiKey,
                    ]
                ])
            );
        } catch (\Exception $e) {
            throw new \Exception(
                'Could not make request to Impala API: ' . $e->getMessage()
            );
        }

        return $response->getBody()->getContents();
    }
}

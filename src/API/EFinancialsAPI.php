<?php

namespace EFinancialsClient\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EFinancialsAPI
{
    public function __construct(
        private ?Client $guzzle = null,
        private string $apiKeyId = '',
        private string $apiKeyPublic = '',
        private string $apiKeyPassword = '',
        private string $apiUrl = "https://demo-rmp-api.rik.ee"
    ) {}

    /**
     * Creates authorization key for HTTP header.
     * For more detailed description check e-Financials API doc.
     *
     * $param string $path relative path of url request.
     */
    public function createAuthKey( $path )
    {
        $data = $this->apiKeyId . ':' . $this->createAuthQuerytime() . ':' . $path;
        $key = $this->apiKeyPassword;

        $requestSignature = base64_encode(hash_hmac('sha384', $data, $key, true));
        $authKey = $this->apiKeyPublic . ':' . $requestSignature;

        return $authKey;
    }

    /**
     * Creates current UTC timestamp.
     */
    public function createAuthQuerytime()
    {
        return gmdate("Y-m-d\TH:i:s");
    }

    /**
     *
     * $param string $method type of HTTP request method.
     * $param string $endpoint relative path of url request.
     * $param array $queryParams array of key-value pairs... GuzzleGm on kindlasti meetod olemas selleks, et concatida
     * $param string $jsonBody ?
     *
     */
    public function request( string $method, string $endpoint, array $queryParams = [], array $jsonBody = [] ) : array
    {

        $queryTime = $this->createAuthQuerytime();
        $authKey   = $this->createAuthKey( $endpoint );

        try {
            $res = $this->request(
                $method,
                'https://demo-rmp-api.rik.ee/v1/clients',
                [
                    'headers' => [
                        'Content-Type'     => 'application/json',
                        'X-AUTH-QUERYTIME' => $queryTime,
                        'X-AUTH-KEY'       => $authKey,
                    ]
                ]
            );

            echo ($res->getBody());

        } catch ( RequestException $e ) {

            $response = $e->getResponse();

            if (!$response) {
                echo( $e->getMessage());
            }

            return [$response]
        }

        return json_decode($response->getBody()->getContents(), true);;
    }
}

$test = new EFinancialsAPI();
$test->request('GET', 'v1/clients');






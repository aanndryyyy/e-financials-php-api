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
        private string $apiUrl = "https://demo-rmp-api.rik.ee",
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
}

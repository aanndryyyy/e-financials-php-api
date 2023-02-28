<?php

namespace EFinancialsClient\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class EFinancialsAPI
{
    public function __construct(
        private ?Client $client = null,
        private string $apiKeyId = '',
        private string $apiKeyPublic = '',
        private string $apiKeyPassword = '',
        private string $apiUrl = "https://demo-rmp-api.rik.ee",
        private string $apiVersion = "v1"
    ) {

        $this->client = new Client(
            [
                'base_uri' => $this->apiUrl,
                'headers'  => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    /**
     * Creates authorization key for HTTP header.
     * For more detailed description check e-Financials API doc.
     *
     * @param string $path Relative path of url request.
     */
    public function createAuthKey(string $path): string
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
    public function createAuthQuerytime(): string
    {
        return gmdate("Y-m-d\TH:i:s");
    }

    /**
     * The universal request method.
     *
     * @param string               $method The HTTP method.
     * @param string               $endpoint The relative path of the request.
     * @param array<string, mixed> $query The query parameters.
     * @param mixed[]              $body The body. Will be converted to JSON.
     *
     * @return mixed The response as array, error, or null.
     */
    public function request(string $method, string $endpoint, array $query = [], array $body = []): mixed
    {
        if (is_null($this->client)) {
            return null;
        }

        $endpoint = '/' . $this->apiVersion . '/' . $endpoint;

        $queryTime = $this->createAuthQuerytime();
        $authKey   = $this->createAuthKey($endpoint);
        $headers   = [
            'X-AUTH-QUERYTIME' => $queryTime,
            'X-AUTH-KEY'       => $authKey,
        ];

        $options = [
            'headers' => $headers,
        ];

        if (count($query) !== 0) {
            $options['query'] = $query;
        }

        if (count($body) !== 0) {
            $options['json'] = $body;
        }

        try {
            $response = $this->client->request($method, $endpoint, $options);
        } catch (RequestException $e) {
            $response = $e->getResponse();

            if ($response instanceof ResponseInterface) {
                return $response->getBody()->getContents();
            }

            return null;
        }

        try {
            $result = \json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR);
        } catch (\ValueError $ve) {
            return [
                'internal_error' => $ve->getMessage(),
            ];
        } catch (\JsonException $je) {
            return [
                'internal_error' => $je->getMessage(),
            ];
        }

        return $result;
    }
}

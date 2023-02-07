<?php

namespace EFinancialsClient\API;

use GuzzleHttp\Client;

class EFinancialsAPI
{
    public function __construct(
        private ?Client $guzzle = null,
        private string $apiKeyId = '',
        private string $apiKeyPublic = '',
        private string $password = '',
        private string $apiUrl = "https://demo-rmp-api.rik.ee"
    ) {

        // TODO: Authentication.
    }
}

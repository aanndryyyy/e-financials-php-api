<?php

namespace EFinancialsClient\API;

use EFinancialsClient\Client;

abstract class AbstractAPI
{
    /**
     * Create a new API instance.
     *
     * @param Client $client
     *
     * @return void
     */
    public function __construct(
        public Client $client
    ) {
        $this->client = $client;
    }
}

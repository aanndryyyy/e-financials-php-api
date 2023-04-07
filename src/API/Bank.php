<?php

namespace EFinancialsClient\API;

class Bank extends AbstractAPI
{
    /**
     * Retrieve the bank account list of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-bank_accounts
     *
     * @return mixed
     */
    public function all(): mixed
    {

        $response = $this->client->request( 'GET', 'bank_accounts' );

        return $response;
    }
}

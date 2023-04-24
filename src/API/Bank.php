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

    /**
     * Retrieve one specific bank account of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-bank_accounts_one
     *
     * @return mixed
     */
    public function get( int $id ): mixed
    {

        $response = $this->client->request( 'GET', 'bank_accounts/' . $id );

        return $response;
    }

    /**
     * Create a new bank account of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/post-bank_accounts
     *
     * @param array<string,mixed>|array{
     * } $parameters
     *
     * @return mixed
     */
    public function create( array $parameters = [] ): mixed
    {
        $missingRequiredParameters = array_diff_key(
            array_flip(
                [
                    'account_name_est',
                    'account_no',
                ]
            ),
            $parameters
        );

        if ( count( $missingRequiredParameters ) !== 0 ) {
            $missingKeys = implode( ', ', array_keys( $missingRequiredParameters ) );

            throw new \InvalidArgumentException(
                "Missing required parameter(s): $missingKeys"
            );
        }

        $response = $this->client->request(
            'POST',
            'bank_accounts',
            [],
            $parameters
        );

        return $response;
    }
}

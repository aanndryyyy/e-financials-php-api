<?php

namespace EFinancialsClient\API;

class InvoiceSeries extends AbstractAPI
{
    /**
     * Retrieve the invoice series list of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-invoice_series
     *
     * @return mixed
     */
    public function all(): mixed
    {

        $response = $this->client->request( 'GET', 'invoice_series' );

        return $response;
    }

    /**
     * Retrieve one specific invoice series of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-invoice_series_one
     *
     * @return mixed
     */
    public function get( int $id ): mixed
    {

        $response = $this->client->request( 'GET', 'invoice_series/' . $id );

        return $response;
    }

    /**
     * Create a new invoice series of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-invoice_series
     *
     * @param array<string,mixed>|array{
     *   "is_active": true,
     *   "is_default": false,
     *   "number_prefix": string,
     *   "number_start_value": 1,
     *   "term_days": 28,
     *   "overdue_charge": 0.15,
     * } $parameters
     *
     * @return mixed
     */
    public function create( array $parameters = [] ): mixed
    {
        $missingRequiredParameters = array_diff_key(
            array_flip(
                [
                    'is_active',
                    'is_default',
                    'number_prefix',
                    'number_start_value',
                    'term_days',
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
            'invoice_series',
            [],
            $parameters
        );

        return $response;
    }
}

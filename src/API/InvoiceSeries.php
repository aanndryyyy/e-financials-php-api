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
}

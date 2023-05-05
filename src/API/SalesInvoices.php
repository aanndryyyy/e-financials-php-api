<?php

namespace EFinancialsClient\API;

class SalesInvoices extends AbstractAPI
{
    /**
     * Retrieve the sale invoice list of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-sale_invoices
     *
     * @return mixed
     */
    public function all(): mixed
    {

        $response = $this->client->request( 'GET', 'sale_invoices' );

        return $response;
    }
}

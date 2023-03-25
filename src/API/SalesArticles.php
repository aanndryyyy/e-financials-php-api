<?php

namespace EFinancialsClient\API;

class SalesArticles extends AbstractAPI
{
    /**
     * Retrieve the sale articles of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-sale_articles
     *
     * @return mixed
     */
    public function all(): mixed
    {

        $response = $this->client->request( 'GET', 'sale_articles' );

        return $response;
    }
}

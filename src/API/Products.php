<?php

namespace EFinancialsClient\API;

class Products extends AbstractAPI
{
    /**
     * Get a product.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-products_one
     *
     * @param int $id Product identificator.
     *
     * @return mixed
     */
    public function get( int $id ): mixed
    {
        $response = $this->client->request( 'GET', 'products/' . $id );

        return $response;
    }
}

<?php

namespace EFinancialsClient\API;

use DateTime;

class Products extends AbstractAPI
{
    /**
     * Retrieve the product list of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-products
     *
     * @param int             $page Page of responses to return.
     * @param DateTime|string $modifiedSince Return only objects modified since provided timestamp.
     *
     * @return mixed
     */
    public function all(int $page = 1, DateTime|string $modifiedSince = ''): mixed
    {
        $query = [];

        if ( $page !== 1 ) {
            $query['page'] = $page;
        }

        if ( $modifiedSince !== '' ) {
            // If $modifiedSince is a DateTime object, format it as an Atom string
            // Otherwise, assign keep it as date string.
            $query['modified_since'] = ($modifiedSince instanceof DateTime)
                ? $modifiedSince -> format( \DateTimeInterface::ATOM )
                : $modifiedSince;
        }

        $response = $this->client->request( 'GET', 'products', $query );

        return $response;
    }

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

    /**
     * Create a product.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/post-products
     *
     * @param string              $name
     * @param string              $code
     * @param array<string,mixed>|array{
     *   "activity_text": string,
     *   "amount": string,
     *   "cl_purchase_articles_id": null,
     *   "cl_sale_articles_id": 1,
     *   "description": null,
     *   "emtak_code": null,
     *   "emtak_version": null,
     *   "foreign_names": array,
     *   "id": int,
     *   "is_deleted": false,
     *   "net_price": null,
     *   "notes": null,
     *   "price_currency": "EUR",
     *   "purchase_accounts_dimensions_id": null,
     *   "purchase_accounts_id": null,
     *   "sale_accounts_dimensions_id": null,
     *   "sale_accounts_id": int,
     *   "sales_price": int,
     *   "translations": array,
     *   "unit": "tk",
     * } $parameters
     *
     * @return mixed
     */
    public function create( string $name, string $code, array $parameters = [] ): mixed
    {

        $required_parameters = [
            "name" => $name,
            "code" => $code,
        ];

        $response = $this->client->request(
            'POST',
            'products',
            [],
            \array_merge( $required_parameters, $parameters )
        );

        return $response;
    }

    /**
     * Modify one specific product of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/patch-products_one
     *
     * @param int $id Product identificator.
     * @param array<string,mixed>|array{
     *   "activity_text": string,
     *   "amount": string,
     *   "cl_purchase_articles_id": null,
     *   "cl_sale_articles_id": 1,
     *   "description": null,
     *   "emtak_code": null,
     *   "emtak_version": null,
     *   "foreign_names": array,
     *   "id": int,
     *   "is_deleted": false,
     *   "net_price": null,
     *   "notes": null,
     *   "price_currency": "EUR",
     *   "purchase_accounts_dimensions_id": null,
     *   "purchase_accounts_id": null,
     *   "sale_accounts_dimensions_id": null,
     *   "sale_accounts_id": int,
     *   "sales_price": int,
     *   "translations": array,
     *   "unit": "tk",
     * } $parameters
     *
     * @return mixed
     */
    public function update( int $id, array $parameters = [] ): mixed
    {

        $missingRequiredParameters = array_diff_key(
            array_flip(
                [
                    'name',
                    'code',
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
            'PATCH',
            'products/' . $id,
            [],
            $parameters,
        );

        return $response;
    }

    /**
     * Delete one specific product of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/delete-products_one
     *
     * @param int $id Product identificator.
     *
     * @return mixed
     */
    public function delete( int $id ): mixed
    {
        $response = $this->client->request( 'DELETE', 'products/' . $id );

        return $response;
    }

    /**
     * Deactivate one specific product of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/patch-products_one_deactivate
     *
     * @param int $id Product identificator.
     */
    public function deactivate( int $id ): mixed
    {
        $response = $this->client->request( 'PATCH', 'products/' . $id . '/deactivate' );

        return $response;
    }

    /**
     * Reactivate one specific product of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/patch-products_one_reactivate
     *
     * @param int $id Product identificator.
     */
    public function reactivate( int $id ): mixed
    {
        $response = $this->client->request( 'PATCH', 'products/' . $id . '/reactivate' );

        return $response;
    }
}

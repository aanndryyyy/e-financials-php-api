<?php

namespace EFinancialsClient\API;

use DateTime;

class Clients extends AbstractAPI
{
    /**
     * Get the clients.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-clients e-Financials API
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

        $response = $this->client->request( 'GET', 'clients', $query );

        return $response;
    }
}

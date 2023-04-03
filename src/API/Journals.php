<?php

namespace EFinancialsClient\API;

use DateTime;

class Journals extends AbstractAPI
{
    /**
     * Retrieve the journal entry list of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-journals
     *
     * @param int             $page Page of responses to return.
     * @param DateTime|string $modifiedSince Return only objects modified since provided timestamp.
     * @param DateTime|string $startDate Effective date on given date or later.
     * @param DateTime|string $endDate Effective date on given date or before.
     *
     * @return mixed
     */
    public function all(
        int $page = 1,
        DateTime|string $modifiedSince = '',
        DateTime|string $startDate = '',
        DateTime|string $endDate = '',
    ): mixed {

        $query = [];

        if ( $page !== 1 ) {
            $query['page'] = $page;
        }

        if ( $modifiedSince !== '' ) {
            $query['modified_since'] = ($modifiedSince instanceof DateTime)
                ? $modifiedSince->format( \DateTimeInterface::ATOM )
                : $modifiedSince;
        }

        if ( $startDate !== '' ) {
            $query['start_date'] = ($startDate instanceof DateTime)
                ? $startDate->format( 'Y-m-d' )
                : $startDate;
        }

        if ( $endDate !== '' ) {
            $query['end_date'] = ($endDate instanceof DateTime)
                ? $endDate->format( 'Y-m-d' )
                : $endDate;
        }

        $response = $this->client->request( 'GET', 'journals', $query );

        return $response;
    }
}

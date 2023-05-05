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

    /**
     * Retrieve one specific sale invoice of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/get-sale_invoices_one
     *
     * @return mixed
     */
    public function get( int $id ): mixed
    {

        $response = $this->client->request( 'GET', 'sale_invoices/' . $id );

        return $response;
    }

    /**
     * Create a new bank account of the specified company.
     *
     * @see https://rmp-api.rik.ee/api.html#operation/post-bank_accounts
     *
     * @param array<string,mixed>|array{
     * "additional_info_content": null,
     * "assembled_in_member_state": false,
     * "bank_accounts_id": null,
     * "bank_payment_orders_id": null,
     * "bank_ref_number": "116758",
     * "base_document_files_id": null,
     * "base_gross_price": 48729.6,
     * "base_net_price": 40608,
     * "base_vat20_price": 8121.6,
     * "base_vat9_price": 0,
     * "base_vat5_price": 0,
     * "cash_accounts_dimensions_id": null,
     * "cash_accounts_id": null,
     * "cash_payment_date": null,
     * "cl_countries_id": "EST",
     * "cl_currencies_id": "EUR",
     * "cl_templates_id": 1,
     * "client_name": "PAypal",
     * "client_vat_no": null,
     * "clients_id": 126,
     * "contract_number": null,
     * "create_date": "2016-02-15",
     * "credit_invoice_payment_type": null,
     * "credit_sale_invoices_id": null,
     * "currency_rate": 1,
     * "files_id": 3419,
     * "gross_price": 48729.6,
     * "id": 1698,
     * "intra_community_supply": false,
     * "invoice_content_code": null,
     * "invoice_content_text": null,
     * "invoice_info": null,
     * "is_doubtful": false,
     * "is_hopeless": false,
     * "is_xls_imported": false,
     * "journal_date": "2016-02-15",
     * "net_price": 40608,
     * "notes": null,
     * "number": "NX91",
     * "number_prefix": "NX",
     * "number_suffix": "91",
     * "overdue_charge": 0.15,
     * "paid_in_cash": false,
     * "payment_description": null,
     * "payment_status": null,
     * "period_end_date": null,
     * "period_start_date": null,
     * "receivable_accounts_dimensions_id": null,
     * "receivable_accounts_id": 1210,
     * "recipient_subclients_id": null,
     * "recipient_clients_id": null,
     * "sale_invoice_type": "INVOICE",
     * "show_client_balance": false,
     * "status": "CONFIRMED",
     * "subclients_id": null,
     * "term_days": 30,
     * "trade_secret": false,
     * "triangulation": false,
     * "triangulation_seller_invoice_vat_no": null,
     * "use_per_item_rounding": false,
     * "vat20_price": 8121.6,
     * "vat9_price": 0,
     * "vat5_price": 0
     * } $parameters
     *
     * @return mixed
     */
    public function create( array $parameters = [] ): mixed
    {
        $missingRequiredParameters = array_diff_key(
            array_flip(
                [
                    'sale_invoice_type',
                    'cl_templates_id',
                    'clients_id',
                    'cl_countries_id',
                    'number_suffix',
                    'create_date',
                    'journal_date',
                    'term_days',
                    'cl_currencies_id',
                    'show_client_balance',
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
            'sale_invoices',
            [],
            $parameters
        );

        return $response;
    }
}

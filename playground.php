<?php

require __DIR__ . '/vendor/autoload.php';

use EFinancialsClient\API\EFinancialsAPI;

$test = new EFinancialsAPI(
    apiKeyId: '987a4443965a46f8bbf1fb6586441f19',
    apiKeyPublic: 'aWQ9OTg3YTQ0NDM5NjVhNDZmOGJiZjFmYjY1ODY0NDFmMTkmZGlnZXN0PTE5MTZlODAwYjhjNzg5MDM3NzQwOTMxODA5MmE3NjA0Mzc2OGEwZWI5NWQ1OTM4YWFhM2IzZDdhM2Q4YzkzYzI=',
    apiKeyPassword: '5f1f35f6fb4b41628c6fbc5431a56ab1'
);

print_r($test->getClients(page: 1));
// print_r( $test->request('GET', '/v1/products') );
// print_r( $test->request('GET', '/v1/projects') );
// print_r( $test->request('GET', '/v1/journals') );
// print_r( $test->request('GET', '/v1/invoice_info') );
// print_r( $test->request('GET', '/v1/invoice_series') );
// print_r( $test->request('GET', '/v1/bank_accounts') );

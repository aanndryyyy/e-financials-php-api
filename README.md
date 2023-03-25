# README
TODO

## Example

```php
<?php

require 'vendor/autoload.php';

use EFinancialsClient\Client;

$client = new Client(
    apiKeyId: 'api_key_id',
    apiKeyPublic: 'api_key_public',
    apiKeyPassword: 'api_key_password',
);

print_r( $client->clients()->all() );
print_r( $client->purchaseArticles()->all() );
print_r( $client->salesArticles()->all() );
```

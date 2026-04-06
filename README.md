# Blaaiz PHP SDK

Framework-agnostic PHP SDK for the Blaaiz RaaS (Remittance as a Service) API.

## Installation

```bash
composer require blaaiz/blaaiz-php-sdk
```

## Quick Start

### OAuth 2.0

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Blaaiz\PhpSdk\Blaaiz;

$blaaiz = new Blaaiz([
    'client_id' => 'your-client-id',
    'client_secret' => 'your-client-secret',
    'base_url' => 'https://api-dev.blaaiz.com',
]);

$currencies = $blaaiz->currencies()->list();
```

### Legacy API key

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Blaaiz\PhpSdk\Blaaiz;

$blaaiz = new Blaaiz([
    'api_key' => 'your-api-key',
    'base_url' => 'https://api-dev.blaaiz.com',
]);

$wallets = $blaaiz->wallets()->list();
```

When both OAuth credentials and an API key are provided, OAuth is used.

## Configuration

The SDK constructor accepts:

```php
[
    'api_key' => '...',
    'client_id' => '...',
    'client_secret' => '...',
    'oauth_scope' => 'wallet:read currency:read ...',
    'base_url' => 'https://api-dev.blaaiz.com',
    'timeout' => 30,
]
```

## Available Services

- `customers()`
- `collections()`
- `payouts()`
- `wallets()`
- `virtualBankAccounts()`
- `transactions()`
- `banks()`
- `currencies()`
- `fees()`
- `files()`
- `webhooks()`
- `rates()`
- `swaps()`

These services are also exposed as public properties, for example `$blaaiz->customers`.

## Common Examples

### Create a customer

```php
$customer = $blaaiz->customers()->create([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'type' => 'individual',
    'email' => 'john.doe@example.com',
    'country' => 'NG',
    'id_type' => 'passport',
    'id_number' => 'A12345678',
]);
```

### Initiate a payout

```php
$payout = $blaaiz->payouts()->initiate([
    'wallet_id' => 'wallet-id',
    'customer_id' => 'customer-id',
    'method' => 'bank_transfer',
    'from_currency_id' => 'USD',
    'to_currency_id' => 'NGN',
    'from_amount' => 100,
    'bank_id' => 'bank-id',
    'account_number' => '0123456789',
]);
```

### Upload a KYC document

```php
$result = $blaaiz->customers()->uploadFileComplete('customer-id', [
    'file' => __DIR__ . '/passport.pdf',
    'file_category' => 'identity',
]);
```

### Verify a webhook

```php
$event = $blaaiz->webhooks()->constructEvent(
    file_get_contents('php://input'),
    $_SERVER['HTTP_X_BLAAIZ_SIGNATURE'] ?? '',
    $_SERVER['HTTP_X_BLAAIZ_TIMESTAMP'] ?? '',
    'your-webhook-secret'
);
```

## API Reference

- [Root SDK helpers](docs/root-sdk.md)
- [Customers](docs/customers.md)
- [Collections](docs/collections.md)
- [Payouts](docs/payouts.md)
- [Wallets and virtual bank accounts](docs/wallets-and-vbas.md)
- [Transactions, banks, currencies, and rates](docs/transactions-banks-currencies-rates.md)
- [Fees and files](docs/fees-files.md)
- [Webhooks](docs/webhooks.md)
- [Swaps](docs/swaps.md)

## Runnable Examples

See [examples/README.md](examples/README.md) for runnable sample scripts.

## High-Level Helpers

The root SDK object includes:

- `testConnection()`
- `createCompletePayout(array $config)`
- `createCompleteCollection(array $config)`

These helpers compose the lower-level services for common workflows.

## Error Handling

```php
use Blaaiz\PhpSdk\Exceptions\BlaaizException;

try {
    $blaaiz->currencies()->list();
} catch (BlaaizException $e) {
    var_dump($e->toArray());
}
```

## Development

```bash
composer install
composer test
composer analyse
```

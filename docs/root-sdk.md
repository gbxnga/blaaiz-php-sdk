# Root SDK

## `__construct(array $options = [])`

Create an SDK instance with either OAuth credentials or a legacy API key.

```php
use Blaaiz\PhpSdk\Blaaiz;

$blaaiz = new Blaaiz([
    'client_id' => 'your-client-id',
    'client_secret' => 'your-client-secret',
    'base_url' => 'https://api-dev.blaaiz.com',
    'timeout' => 30,
]);
```

You can also authenticate with a legacy API key:

```php
$blaaiz = new Blaaiz([
    'api_key' => 'your-api-key',
    'base_url' => 'https://api-dev.blaaiz.com',
]);
```

## Service accessors

The root SDK exposes service accessors:

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

These are also available as public properties such as `$blaaiz->customers`.

## `testConnection()`

Performs a lightweight connectivity check by calling the currencies endpoint.

```php
if ($blaaiz->testConnection()) {
    echo 'Connected';
}
```

## `createCompletePayout(array $payoutConfig)`

Creates a customer when needed, calculates fees, and initiates the payout.

```php
$result = $blaaiz->createCompletePayout([
    'customer_data' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'type' => 'individual',
        'email' => 'john@example.com',
        'country' => 'NG',
        'id_type' => 'passport',
        'id_number' => 'A12345678',
    ],
    'payout_data' => [
        'wallet_id' => 'wallet-id',
        'method' => 'bank_transfer',
        'from_currency_id' => 'USD',
        'to_currency_id' => 'NGN',
        'from_amount' => 100,
        'bank_id' => 'bank-id',
        'account_number' => '0123456789',
    ],
]);
```

You can skip `customer_data` if `payout_data.customer_id` already exists.

## `createCompleteCollection(array $collectionConfig)`

Creates a customer when needed, optionally creates a virtual bank account, and initiates the collection.

```php
$result = $blaaiz->createCompleteCollection([
    'customer_data' => [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'type' => 'individual',
        'email' => 'jane@example.com',
        'country' => 'NG',
        'id_type' => 'passport',
        'id_number' => 'B12345678',
    ],
    'collection_data' => [
        'wallet_id' => 'wallet-id',
        'amount' => 100,
        'currency' => 'NGN',
        'method' => 'bank_transfer',
    ],
    'create_vba' => true,
]);
```

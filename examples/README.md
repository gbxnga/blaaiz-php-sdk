# Examples

These scripts are small runnable examples for common SDK workflows.

## Setup

Install dependencies first:

```bash
composer install
```

Set either OAuth credentials:

```bash
export BLAAIZ_CLIENT_ID=your-client-id
export BLAAIZ_CLIENT_SECRET=your-client-secret
export BLAAIZ_API_URL=https://api-dev.blaaiz.com
```

or a legacy API key:

```bash
export BLAAIZ_API_KEY=your-api-key
export BLAAIZ_API_URL=https://api-dev.blaaiz.com
```

## Run examples

```bash
php examples/get-rates.php
php examples/create-customer.php
php examples/initiate-payout.php
php examples/upload-kyc-file.php /absolute/path/to/passport.pdf
php examples/verify-webhook.php
```

## Files

- `bootstrap.php`: shared SDK bootstrap and JSON output helper
- `get-rates.php`: fetch exchange rates
- `create-customer.php`: create an individual customer
- `initiate-payout.php`: initiate a sample bank transfer payout
- `upload-kyc-file.php`: upload an identity document with `uploadFileComplete()`
- `verify-webhook.php`: verify and parse a signed webhook payload

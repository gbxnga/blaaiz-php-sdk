# Test Suite

This package uses Pest for unit, feature, and optional live integration tests.

## Run tests

```bash
composer test
```

## Integration tests

Integration tests run against the Blaaiz API only when credentials are present in the shell environment.

Supported variables:

- `BLAAIZ_API_KEY`
- `BLAAIZ_CLIENT_ID`
- `BLAAIZ_CLIENT_SECRET`
- `BLAAIZ_OAUTH_SCOPE`
- `BLAAIZ_API_URL`

Without credentials, the integration tests are skipped.

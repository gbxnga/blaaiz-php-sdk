<?php

declare(strict_types=1);

use Blaaiz\PhpSdk\Blaaiz;

require dirname(__DIR__) . '/vendor/autoload.php';

function createBlaaizClient(): Blaaiz
{
    $baseUrl = getenv('BLAAIZ_API_URL') ?: 'https://api-dev.blaaiz.com';
    $timeout = (int) (getenv('BLAAIZ_TIMEOUT') ?: 30);

    $clientId = getenv('BLAAIZ_CLIENT_ID') ?: '';
    $clientSecret = getenv('BLAAIZ_CLIENT_SECRET') ?: '';
    $apiKey = getenv('BLAAIZ_API_KEY') ?: '';
    $oauthScope = getenv('BLAAIZ_OAUTH_SCOPE') ?: '';

    if ($clientId !== '' && $clientSecret !== '') {
        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'base_url' => $baseUrl,
            'timeout' => $timeout,
        ];

        if ($oauthScope !== '') {
            $options['oauth_scope'] = $oauthScope;
        }

        return new Blaaiz($options);
    }

    if ($apiKey !== '') {
        return new Blaaiz([
            'api_key' => $apiKey,
            'base_url' => $baseUrl,
            'timeout' => $timeout,
        ]);
    }

    fwrite(STDERR, "Set BLAAIZ_CLIENT_ID and BLAAIZ_CLIENT_SECRET, or BLAAIZ_API_KEY.\n");
    exit(1);
}

function printJson(mixed $data): void
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    if ($json === false) {
        fwrite(STDERR, "Failed to encode JSON output.\n");
        exit(1);
    }

    fwrite(STDOUT, $json . PHP_EOL);
}

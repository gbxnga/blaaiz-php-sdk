<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$payload = '{"transaction_id":"txn_123","status":"completed"}';
$timestamp = (string) time();
$secret = getenv('BLAAIZ_WEBHOOK_SECRET') ?: 'test-webhook-secret';
$signature = hash_hmac('sha256', $timestamp . '.' . $payload, $secret);

$blaaiz = createBlaaizClient();

$event = $blaaiz->webhooks()->constructEvent($payload, $signature, $timestamp, $secret);

printJson($event);

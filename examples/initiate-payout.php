<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$blaaiz = createBlaaizClient();

$walletId = getenv('BLAAIZ_WALLET_ID') ?: 'wallet-id';
$customerId = getenv('BLAAIZ_CUSTOMER_ID') ?: 'customer-id';
$bankId = getenv('BLAAIZ_BANK_ID') ?: 'bank-id';
$accountNumber = getenv('BLAAIZ_ACCOUNT_NUMBER') ?: '0123456789';

$payout = $blaaiz->payouts()->initiate([
    'wallet_id' => $walletId,
    'customer_id' => $customerId,
    'method' => 'bank_transfer',
    'from_currency_id' => 'USD',
    'to_currency_id' => 'NGN',
    'from_amount' => 100,
    'bank_id' => $bankId,
    'account_number' => $accountNumber,
]);

printJson($payout);

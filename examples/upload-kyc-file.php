<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$filePath = $argv[1] ?? null;
$customerId = getenv('BLAAIZ_CUSTOMER_ID') ?: 'customer-id';

if ($filePath === null || !is_file($filePath)) {
    fwrite(STDERR, "Usage: php examples/upload-kyc-file.php /absolute/path/to/file\n");
    exit(1);
}

$blaaiz = createBlaaizClient();

$result = $blaaiz->customers()->uploadFileComplete($customerId, [
    'file' => $filePath,
    'file_category' => 'identity',
]);

printJson($result);

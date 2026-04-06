<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$blaaiz = createBlaaizClient();

$customer = $blaaiz->customers()->create([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'type' => 'individual',
    'email' => 'john.doe.' . bin2hex(random_bytes(4)) . '@example.com',
    'country' => 'NG',
    'id_type' => 'passport',
    'id_number' => 'A' . strtoupper(bin2hex(random_bytes(4))),
]);

printJson($customer);

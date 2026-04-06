<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$blaaiz = createBlaaizClient();

printJson($blaaiz->rates()->list());

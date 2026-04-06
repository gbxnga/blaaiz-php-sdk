<?php

uses()->in('Feature', 'Unit', 'Integration');

/**
 * Read test configuration from the process environment.
 */
function testEnv(string $key, ?string $default = null): ?string
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return $value;
}

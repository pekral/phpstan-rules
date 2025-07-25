<?php

declare(strict_types = 1);

// Example value, replace with real input in production
$value = (bool)rand(0, 1) ? 'foo' : null;
$result = $value ?? 'default';
echo $result; 
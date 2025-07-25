<?php

/** @var string|null $value */
$value = $_GET['value'] ?? null;
$result = $value ?? 'default';
echo $result; 
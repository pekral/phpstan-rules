<?php

$input = file_get_contents('php://input');
if ($input === false) {
    $input = '';
}
$arr = json_decode($input, true);
if (!is_array($arr)) {
    $arr = [];
}
if (count($arr) === 0) {
    echo 'Array is empty!';
} 
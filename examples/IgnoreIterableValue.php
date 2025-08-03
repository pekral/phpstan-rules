<?php

declare(strict_types = 1);

class IgnoreIterableValue
{

    public function test(array $array): array
    {
        return $array;
    }

}
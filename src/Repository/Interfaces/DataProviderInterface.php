<?php

namespace App\Repository\Interfaces;

interface DataProviderInterface
{
    public function getData(string $url): array;
}
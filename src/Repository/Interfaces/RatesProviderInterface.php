<?php

namespace App\Repository\Interfaces;

interface RatesProviderInterface
{
    public function getRates(string $url): array;
}
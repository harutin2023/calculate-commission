<?php

namespace App\Repository\Interfaces;

interface CommissionRepository
{
    public function calculate(float $amount, bool $isEuropeCountry);
}
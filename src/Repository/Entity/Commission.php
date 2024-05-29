<?php

namespace App\Repositroy\Entity;

use App\Repository\Interfaces\CommissionRepository;
use App\Repository\Interfaces\CurrencyInterface;

/**
 * Possible that here must be dependency from transaction object if this is database entity.
 * But currently transaction here is not needed.
 */
class Commission implements CommissionRepository
{
    const EUROPE_FEE = 0.01;

    const WORLD_FEE = 0.02;

    /**
     * @param float $amount
     * @param bool $isEuropeCountry
     * @return float
     */
    public function calculate(float $amount, bool $isEuropeCountry): float
    {
        $commissionRate = $isEuropeCountry ? self::EUROPE_FEE : self::WORLD_FEE;
        return $amount * $commissionRate;
    }
}
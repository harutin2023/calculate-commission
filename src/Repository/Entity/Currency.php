<?php
namespace App\Repository\Entity;

use App\Repository\Interfaces\CurrencyInterface;
class Currency implements CurrencyInterface
{
    public function __construct(public string $currency)
    {

    }

    /**
     * @return bool
     */
    public function isEuro(): bool
    {
        return $this->currency === 'EUR';
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->currency;
    }
}

<?php

namespace App\Repository\Entity;

use App\Repository\Interfaces\CurrencyInterface;
use App\Repository\Interfaces\TransactionRepository;
use App\Repository\Interfaces\TransactionInterface;

class Transaction implements TransactionRepository, TransactionInterface
{
    private string $bin;

    private float $amount;

    private string $currency;

    public function __construct(string $binCode, float $amount, string $currency)
    {
        $this->bin = $binCode;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getBinCode(): string
    {
        return $this->bin;
    }

    public function setBinCode(string $binCode): void
    {
        $this->bin = $binCode;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrency(): CurrencyInterface
    {
        return new Currency($this->currency);
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
}
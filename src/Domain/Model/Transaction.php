<?php
namespace App\Domain\Model;

use App\Repository\Entity\Transaction as TransactionEntity;

class Transaction extends TransactionEntity implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $bin;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'bin' => $this->bin,
            'amount' => $this->amount,
            'currency' => $this->currency
        ];
    }
}

<?php
namespace App\Services;

use App\Repository\Interfaces\DataProviderInterface;
use App\Traits\HelperTrait;
use App\Domain\Model\Transaction;
use App\Traits\Singleton;
use App\Repositroy\Entity\Commission;

class TransactionService extends Transaction
{
    use Singleton, HelperTrait;

    private array $transactions = [];
    private array $commissions = [];

    /**
     * @param array $transactions
     * @return void
     */
    public function setTransactions(array $transactions): void
    {
        $this->transactions = $transactions;
    }

    /**
     * @param DataProviderInterface $dataProvider
     * @return array
     */
    public function calculateCommission(DataProviderInterface $dataProvider): array
    {
        if(empty($this->transactions)) {
            return [];
        }

        $rates = $dataProvider->getData(getenv('RATES_API'));
        $commissions = [];
        foreach ($this->transactions as $transaction)
        {
            $transaction = new Transaction($transaction['bin'], $transaction['amount'], $transaction['currency']);
            $amount = $transaction->getAmount();

            if (!$transaction->getCurrency()->isEuro()) {
                $amount = $this->convert($rates, $transaction->getCurrency()->toString(), $amount);
            }
            $cardData = $dataProvider->getData(getenv('PROVIDER_URL') . '/' . $transaction->getBinCode());
            $isEurope = $this->isEuropeCountry($cardData['country']['alpha2']);

            $commission = new Commission();
            $commissionAmount = $commission->calculate($amount, $isEurope);

            $commissions[] = $this->ceil($commissionAmount, 2);
        }
        $this->commissions = $commissions;
        return $commissions;
    }

    /**
     * @return void
     */
    public function printCommissions(): void
    {
        foreach ($this->commissions as $commission) {
            $result = "$commission\n";
            file_put_contents("php://output", $result);
        }
    }
}

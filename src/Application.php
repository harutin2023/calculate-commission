<?php

namespace App;

use App\Traits\Singleton;
use App\Repository\Interfaces\ServicesInterface;

class Application
{
    use Singleton;
    private ServicesInterface $services;

    public function run()
    {
        $this->services->fileReader->setFilePath($_SERVER['argv'][1]);
        $transactions = $this->services->fileReader->getFileData();
        $this->services->transactionService->setTransactions($transactions);
        $this->services->transactionService->calculateCommission($this->services->dataProvider);
        $this->services->transactionService->printCommissions();
    }

    /**
     * @param ServicesInterface $services
     * @return void
     */
    public function setServices(ServicesInterface $services): void
    {
        $this->services = $services;
    }

    /**
     * @return ServicesInterface
     */
    public function getServices(): ServicesInterface
    {
        return $this->services;
    }
}

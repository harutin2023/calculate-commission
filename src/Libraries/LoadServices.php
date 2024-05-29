<?php
namespace App\Libraries;

use App\Repository\Interfaces\ServicesInterface;
use App\Repository\Interfaces\DataProviderInterface;
use App\Repository\Interfaces\FileReaderInterface;
use App\Repository\Interfaces\TransactionInterface;
use App\Repository\Interfaces\ConverterInterface;
use App\Services\FileReaderService;
use App\Services\TransactionService;
use App\Services\DataProviderService;
use App\Services\ConverterService;

use App\Traits\Singleton;

class LoadServices implements ServicesInterface
{
    use Singleton;

    public FileReaderInterface $fileReader;
    public TransactionInterface $transactionService;
    public DataProviderInterface $dataProvider;
    public ConverterInterface $converter;

    /**
     * @return void
     */
    public function loadCustomDependencies(): ServicesInterface
    {
        $this->fileReader = FileReaderService::getInstance();
        $this->transactionService = TransactionService::getInstance();
        $this->dataProvider = DataProviderService::getInstance();
        return $this;
    }
}

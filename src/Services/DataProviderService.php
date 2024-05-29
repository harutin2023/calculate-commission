<?php
namespace App\Services;

use App\Repository\Interfaces\DataProviderInterface;
use App\Traits\Singleton;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DataProviderService implements DataProviderInterface
{
    use Singleton;

    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     * @return void
     */
    public function setClient(HttpClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $url
     * @return array
     */
    public function getData(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);
        if (!empty($response->toArray()['error'])) {
            throw new \Exception($response->toArray()['error']['info']);
        }
        return $response->toArray();
    }
}
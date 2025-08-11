<?php

namespace App\Twig\Runtime;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Extension\RuntimeExtensionInterface;

class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private readonly CacheInterface $issLocationPool,
        private readonly HttpClientInterface $client,
    ) {
    }

    public function getIssLocationData()
    {
        return $this->issLocationPool->get('iss_location_data', function () {

            $response = $this->client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');
            return $response->toArray();
          });
    }
}

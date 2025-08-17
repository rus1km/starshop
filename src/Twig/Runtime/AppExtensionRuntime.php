<?php

namespace App\Twig\Runtime;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Extension\RuntimeExtensionInterface;

class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private readonly CacheInterface $issLocationPool,
        private readonly HttpClientInterface $client,
        private readonly ?LoggerInterface $logger = null,
    ) {}

    public function getIssLocationData(): array
    {
        return $this->issLocationPool->get('iss_location_data', function () {
            try {
                // $response = $this->client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');
                // return $response->toArray();
                return $this->getFallbackData();
            } catch (TransportExceptionInterface $e) {
                $this->logger?->error('Failed to fetch ISS location data: Transport error', [
                    'error' => $e->getMessage(),
                    'exception' => $e,
                ]);
                return $this->getFallbackData();
            } catch (HttpExceptionInterface $e) {
                $this->logger?->error('Failed to fetch ISS location data: HTTP error', [
                    'status_code' => $e->getResponse()->getStatusCode(),
                    'error' => $e->getMessage(),
                    'exception' => $e,
                ]);
                return $this->getFallbackData();
            } catch (\Exception $e) {
                $this->logger?->error('Failed to fetch ISS location data: Unexpected error', [
                    'error' => $e->getMessage(),
                    'exception' => $e,
                ]);
                return $this->getFallbackData();
            }
        });
    }

    private function getFallbackData(): array
    {
        return [
            'id' => 25544,
            'name' => 'ISS (ZARYA)',
            'latitude' => 0.0,
            'longitude' => 0.0,
            'altitude' => 408.0,
            'velocity' => 0.0,
            'visibility' => 'unknown',
            'footprint' => 0.0,
            'timestamp' => time(),
            'daynum' => 0.0,
            'solar_lat' => 0.0,
            'solar_lon' => 0.0,
            'units' => 'kilometers',
            'error' => true,
        ];
    }
}

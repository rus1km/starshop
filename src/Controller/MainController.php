<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
  #[Route('/', name: 'app_main')]
  public function index(
    StarshipRepository $repository,
    HttpClientInterface $client,
    CacheInterface $cache,
  ): Response {
    $starships = $repository->findAll();

    $myShip = $starships[array_rand($starships)];

    $data = $cache->get('iss_location_data', function (ItemInterface $item) use ($client) {
      $item->expiresAfter(time: 5);

      $response = $client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');
      return $response->toArray();
    });

    return $this->render('main/index.html.twig', [
      'myShip' => $myShip,
      'starships' => $starships,
      'iss' => $data,
    ]);
  }
}

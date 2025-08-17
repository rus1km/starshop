<?php

namespace App\Controller;

use App\Entity\Starship;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

class StarshipController extends AbstractController
{
  #[Route('/starships/{slug}', methods: ['GET'], name: 'app_starship_index')]
  public function index(
    #[MapEntity(mapping: ['slug' => 'slug'])]
    Starship $starship,
  ): Response {
    return $this->render('starship/index.html.twig', [
      'starship' => $starship,
    ]);
  }
}

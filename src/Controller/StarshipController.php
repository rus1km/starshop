<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarshipController extends AbstractController
{
  #[Route('/starships/{id<\d+>}', methods: ['GET'], name: 'app_starship_index')]
  public function index(StarshipRepository $repository, int $id): Response
  {
    $starship = $repository->find($id);

    if (!$starship) {
      throw $this->createNotFoundException('Starship not found');
    }

    return $this->render('starship/index.html.twig', [
      'starship' => $starship,
    ]);
  }
}
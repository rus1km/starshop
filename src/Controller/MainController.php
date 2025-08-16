<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
  #[Route('/', name: 'app_main')]
  public function index(
    StarshipRepository $repository,
  ): Response {
    $starships = $repository->findIncomplete();
    $myShip = $repository->findMyShip();

    return $this->render('main/index.html.twig', [
      'myShip' => $myShip,
      'starships' => $starships,
    ]);
  }
}

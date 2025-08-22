<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use App\Repository\StarshipPartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
  #[Route('/', name: 'app_main')]
  public function index(
    StarshipRepository $repository,
    Request $request,
    StarshipPartRepository $partRepository,
  ): Response {
    $starships = $repository->findIncomplete();
    $starships->setMaxPerPage(5);
    $starships->setCurrentPage($request->query->get('page', 1));
    $myShip = $repository->findMyShip();
    $expensiveParts = $partRepository->getExpensiveParts(10);

    return $this->render('main/index.html.twig', [
      'myShip' => $myShip,
      'starships' => $starships,
      'expensiveParts' => $expensiveParts,
    ]);
  }
}

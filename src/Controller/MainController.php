<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {

      $numberOfStarships = 457;
      $myShip = [
        'name' => 'USS LeafyCruiser (NCC-0001)',
        'class' => 'Garden',
        'captain' => 'Jean-Luc Pickles',
        'status' => 'under construction',
      ];

      return $this->render('main/index.html.twig', [
        'numberOfStarships' => $numberOfStarships,
        'myShip' => $myShip,
      ]);
    }
}

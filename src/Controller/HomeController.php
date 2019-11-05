<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Game;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function listGames()
    {
        $repository = $this->getDoctrine()->getRepository(Game::class);
        $games = $repository->findAll();

        return $this->render('home/home.html.twig', [
            'games' => $games,
        ]);
    }
}

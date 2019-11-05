<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Game;
use App\Entity\ReleaseDate;
use App\Form\GameType;

class GameController extends AbstractController
{
    /**
     * @Route("/game/{id}", name="show_game")
     */
    public function showGame(Game $game)
    {
        // $repo = $this->getDoctrine()->getRepository(Game::class);
        // $game = $repo->find($id);

        // $repo = $this->getDoctrine()->getRepository(ReleaseDate::class);
        // $releases = $repo->findBy(
        //     [
        //         'game' => $game
        //     ]
        // );

        return $this->render('game/game.html.twig', [
            'game' => $game
        ]);
    }

    /**
     * @Route("/edit-game", name="create-game")
     * @Route("/edit-game/{id}", name="edit-game")
     */
    public function showEditGame(Game $game = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$game) {
            $game = new Game();
        }

        // $form = $this->createFormBuilder($game)
        //              ->add('name', TextType::class)
        //              ->add('content', TextareaType::class)
        //              ->getForm();

        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if(!$game->getId()){
                $game->setCoverExtension('jpg');
            }
            
            $manager->persist($game);
            $manager->flush();

            return $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        }

        // if game exists, game is true
        return $this->render('game/gameEdit.html.twig', [
            'editGameForm' => $form->createView(),
            'editGame' => $game->getId() !== null
        ]);
    }
}

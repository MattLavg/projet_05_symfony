<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Game;
use App\Entity\Developer;
use App\Entity\Genre;
use App\Entity\Mode;
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
        

        // dd($request);
        if(!$game) {
            $game = new Game();

            $developer = new Developer();
            $genre = new Genre();
            $mode = new Mode();
            $release = new ReleaseDate();

            $game->addDeveloper($developer);
            $game->addGenre($genre);
            $game->addMode($mode);
            $game->addReleaseDate($release);
        }

        // Get all developers
        // $repo = $this->getDoctrine()->getRepository(Platform::class);
        // $platforms = $repo->findAll();

        // foreach($developersId as $developerId) {
        //     $developer = new Developer();
        //     $developer = $developer->setId($developerId);
        //     dd($game);
        //     $game->addDeveloper($developer);
        // }
        

        // To display developers in select
        // To avoid an empty field
        
        
        
        $form = $this->createForm(GameType::class, $game);

        // dd($request->request->all());
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            // dd($game);
            if(!$game->getId()){
                $game->setCoverExtension('jpg');
            }
            
            $manager->persist($game);
            $manager->flush();

            return $this->redirectToRoute('show_game', ['id' => $game->getId()]);
        }

        $jsFiles = [
            'editFormElements.js',
            'checkForm.js'
        ];

        // if game exists, game is true
        return $this->render('game/gameEdit.html.twig', [
            'editGameForm' => $form->createView(),
            'editGame' => $game->getId() !== null,
            'jsFiles' => $jsFiles
        ]);
    }
}

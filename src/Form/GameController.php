<?php
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Game; 
use App\Form\GameFormType;


class GameController extends AbstractController
{
    
    public function addGame(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameFormType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('home'); 
        }

        return $this->render('game/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}




?>
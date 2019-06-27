<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\DataManager;
use App\Repository\TopicsRepository;
use App\Repository\VoteRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function index(TopicsRepository $topicsRepository, VoteRepository $voteRepo,DataManager $dm)

    {
            if ($this->getUser() !== null) {
    		  $rank = $dm->getRank($this->getUser()->getPoints());  
            } else {
                $rank = null;
            }
        
        return $this->render('home/accueil.html.twig', [
            'controller_name' => 'HomeController',
<<<<<<< HEAD
            'topics' => $topicsRepository->findBy(array('status' => 'Ouvert')),
=======
            'rank' => $rank,
            'topics' => $topicsRepository->findAll(),
>>>>>>> cf1ef130137dbff4ef633f83d0663a640693cfdf
            'votes' => $voteRepo->findAll(),
            'totalDecision' => $topicsRepository->findBy(['status' => ['Refusé', 'Réalisé']]),
        ]);
    }
}
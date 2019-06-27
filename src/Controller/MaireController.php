<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TopicsRepository;
use App\Repository\VoteRepository;


/**
 * @Route("/maire")
 */ 

class MaireController extends AbstractController
{
    /**
     * @Route("/", name="maire_home")
     */
    public function index(TopicsRepository $topicsRepository, VoteRepository $voteRepo)
    {
        return $this->render('home/accueil.html.twig', [
            'controller_name' => 'HomeController',
            'topics' => $topicsRepository->findBy(['status' => 'Revu']),
            'votes' => $voteRepo->findAll(),
            'totalDecision' => $topicsRepository->findBy(['status' => ['Refusé', 'Réalisé']]),
        ]);
    }

}
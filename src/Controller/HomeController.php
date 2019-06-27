<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TopicsRepository;
use App\Repository\VoteRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TopicsRepository $topicsRepository, VoteRepository $voteRepo)
    {
        return $this->render('home/accueil.html.twig', [
            'controller_name' => 'HomeController',
            'topics' => $topicsRepository->findAll(),
            'votes' => $voteRepo->findAll(),
            'totalDecision' => $topicsRepository->findBy(['status' => ['Refusé', 'Réalisé']]),
        ]);
    }
}
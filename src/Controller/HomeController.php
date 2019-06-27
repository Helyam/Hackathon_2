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
    		
        return $this->render('home/accueil.html.twig', [
            'controller_name' => 'HomeController',
            'pointPercentage' => $dm->getRank(),
            'topics' => $topicsRepository->findAll(),
            'votes' => $voteRepo->findAll(),
        ]);
    }
}

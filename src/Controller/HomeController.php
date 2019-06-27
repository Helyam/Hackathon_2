<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\DataManager;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DataManager $dm)
    {
    		
        return $this->render('home/accueil.html.twig', [
            'controller_name' => 'HomeController',
            'pointPercentage' => $dm->getRank()
        ]);
    }
}

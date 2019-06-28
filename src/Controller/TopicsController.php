<?php

namespace App\Controller;

use App\Entity\Topics;
use App\Form\TopicsType;
use App\Repository\TopicsRepository;
use App\Repository\VoteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Vote;

/**
 * @Route("/topics")
 */
class TopicsController extends AbstractController
{
    /**
     * @Route("/", name="topics_index", methods={"GET"})
     */
    public function index(TopicsRepository $topicsRepository): Response
    {
        return $this->render('topics/index.html.twig', [
            'topics' => $topicsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="topics_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $topic = new Topics();
        $form = $this->createForm(TopicsType::class, $topic);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $topic->setDateDeCreation(new \DateTime())
              ->setAuteur($user)
              ->setStatus('lancement du vote')
              ->setVotePositif(0)
              ->setVoteNegatif(0)
              ->setBudget(0)
              ->setReponse('En attente de la fin du vote');


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topic);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('topics_index');
        }

        return $this->render('topics/new.html.twig', [
            'topic' => $topic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="topics_show", methods={"GET"})
     */
    public function show(Topics $topic, TopicsRepository $topicsRepository, VoteRepository $voteRepo): Response
    {    
        $myVote = 'undefined';
        if ($this->getUser()) {
            $vote = $voteRepo->findOneBy(['topic' => $topic->getId(),
                                        'user' => $this->getUser()->getId()
                                            ]);
            if ($vote) {
                $vote->getIsPositif()? $myVote ='like': $myVote = 'dislike';
            }
         } 

        return $this->render('topics/show.html.twig', [
            'myVote' => $myVote,
            'topic' => $topic,
            'topics' => $topicsRepository->findAll(),
        ]);
    }

      /**
      * @Route("/{id}/edit", name="topics_edit", methods={"GET","POST"})
      */
     public function edit(Request $request, Topics $topic,ObjectManager $manager): Response
     {
        $user = $this->get('security.token_storage')->getToken()->getUser();

         $form = $this->createForm(TopicsType::class, $topic);
         $form->handleRequest($request);

         if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user->getStatus() == "representant") {
            $topic->setBudget($_POST['budget']);
            $topic->setReponse($_POST['response']);
            $topic->setStatus('A Valider');
            $manager->flush();

             return $this->redirectToRoute('topics_index', [
                 'id' => $topic->getId(),
             ]);
         }

         return $this->render('topics/edit.html.twig', [
             'topic' => $topic,
             'form' => $form->createView(),
         ]);
     }

    /**
     * @Route("/{id}", name="topics_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Topics $topic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$topic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($topic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('topics_index');
    }
     /**
     * @Route("/vote/plus/{id}", name="topics_plus", methods={"POST"})
     */
    public function VotePositif(Request $request, Topics $topic, Objectmanager $manager, VoteRepository $voteRepo, TopicsRepository $topicsRepository)
    {

        $votes = $voteRepo->findBy(['topic' => $topic->getId(),
                                    'user' => $this->getUser()->getId()
                                        ]);
        // si l'id du user connecté n'est pas présent dans la  base de donnée pour le topic concerné alors etc ...
        if ($request->getMethod() == 'POST' && !$votes) {
            $topic->setVotePositif($topic->getVotePositif() + 1);
            $vote = new Vote();
            $vote ->setUser($this->getUser())
                  ->setTopic($topic)
                  ->setIsPositif(true);
            $manager->persist($vote);
            $manager->flush();

            return $this->redirectToRoute("topics_show", ['id' => $topic->getId()]);
        }
        return $this->render('topics/show.html.twig', [
            'topic' => $topic,
            'topics' => $topicsRepository->findAll(),
        ]);
    }
     /**
     * @Route("/vote/moins/{id}", name="topics_moins", methods={"POST"})
     */
    public function VoteNegatif(Topics $topic)
    {
        if (isSubmitted) {
            $topic->getVotePositif();

            return $this->redirectToRoute('topics_show');
        }
        return $this->render('topics/show.html.twig');
    }

     /**
     * @Route("/{id}/like/{like}", name="topics_like", methods={"POST"})
     */
    public function topicLike(Request $request, Topics $topic, string $like,VoteRepository $voteRepo)
    {
        if ($like != 'undefined' ) {
            $entityManager = $this->getDoctrine()->getManager();
            $userVote = $voteRepo->findOneBy(['topic' => $topic->getId(),
                                        'user' => $this->getUser()->getId()
                                            ]);
            if ($userVote){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($userVote);
                if ($like == 'like') {
                $topic->setVotePositif($topic->getVotePositif() + 1);
                $topic->setVoteNegatif($topic->getVoteNegatif() - 1);
                    }
                else
                {
                $topic->setVotePositif($topic->getVotePositif() - 1);
                $topic->setVoteNegatif($topic->getVoteNegatif() + 1); 
                }
            }
            $newVote = new Vote();
            $newVote ->setUser($this->getUser())
                  ->setTopic($topic);
            $like == 'like'?$newVote->setIsPositif(true):$newVote->setIsPositif(false);
            $entityManager->persist($newVote);
            $entityManager->flush();
        }

        return $this->json([
            'like' => $like
        ]); 
    }

    
}

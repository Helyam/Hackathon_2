<?php

namespace App\Controller;

use App\Entity\Topics;
use App\Form\TopicsType;
use App\Repository\TopicsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;


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
    public function show(Topics $topic): Response
    {
        return $this->render('topics/show.html.twig', [
            'topic' => $topic,
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
}

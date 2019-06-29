<?php
namespace App\Services;

use App\Entity\Topics;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\VoteRepository;

Class StatusUpdate 
{
		private $voteRepo;

        public function __construct(VoteRepository $voteRepo)
        {
                $this->voteRepo = $voteRepo;
        }
		public function checkStatus(Topics $topic)
		{
                
            $Pourcentage = $topic->getVotePositif() * 100 / ($topic->getVotePositif() + $topic->getVoteNegatif());

            if($topic->getVotePositif() + $topic->getVoteNegatif() > 20)
            {

                if($Pourcentage >= 60)
                {
                    if($topic->getStatus() == "Ouvert")
                    {
                        $topics =$this->voteRepo->findBy(['topic' => $topic]);

                    $entityManager = $this->getDoctrine()->getManager();
                        foreach ($topici as $key => $value) {
                            $entityManager->remove($topici);
                        }
                        $entityManager->flush();

                        $topic->setStatus('Revu');
                    }

                    if($topic->getStatus() == "A Valider")
                    {
                        $topic->setStatus('Realisé');
                    }
                }
            }
			return $topic;
		}
}

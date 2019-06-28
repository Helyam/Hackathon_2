<?php
namespace App\Services;

use App\Entity\Topics;

Class StatusUpdate 
{
		
		public function checkStatus(Topics $topic)
		{
                
            $Pourcentage = $topic->getVotePositif() * 100 / ($topic->getVotePositif() + $topic->getVoteNegatif());

            if($topic->getVotePositif() + $topic->getVoteNegatif() > 20)
            {

                if($Pourcentage >= 60)
                {
                    if($topic->getStatus() == "Ouvert")
                    {
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

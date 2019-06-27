<?php

namespace App\DataFixtures;

use App\Entity\Vote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VoteFixtures extends Fixture implements DependentFixtureInterface 
{
	public function load(ObjectManager $manager)
	{
		$faker  =  Faker\Factory::create('fr_FR');

		$ispostif = [true,false];

		for ($i=0; $i <500 ; $i++) { 
			$vote = New Vote();
			$vote->setUser($this->getReference('vote' . rand(0,99)));			
			$vote->setTopic($this->getReference('topic' . rand(1,8)));
			$vote->setIspositif(array_rand($ispostif,1));

			$manager->persist($vote);
		
			$manager->flush();
		}
	}

	public function getDependencies()
 	{
    return [UserFixtures::class,
    	    TopicsFixtures::class];
	}
}
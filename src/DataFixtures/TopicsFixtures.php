<?php

namespace App\DataFixtures;

use App\Entity\Topics;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TopicsFixtures extends Fixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager)
	{

		$status = ['Ouvert', 'Revu', 'A Valider', 'Refusé', 'Realisé' ];

		$faker  =  Faker\Factory::create('fr_FR');

		for ($i=20; $i <21 ; $i++) { 
			$topics = New Topics();
			$topics->setTitre($faker->title);
			$topics->SetContent($faker->text);
			$topics->setPicture('http://lorempixel.com/400/200/');
			$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
			$topics->setStatus('Ouvert');
			$topics->setVotePositif(rand(0,100));
			$topics->setVoteNegatif(rand(0,100));
			$topics->setBudget(rand(0,100000));
			$topics->setReponse($faker->title);
			$topics->setAuteur($this->getReference('user' . $i));

			$this->addReference('topic' . $i, $topics, $topics);

			$manager->persist($topics);		

			$manager->flush();
		}

		$topics = New Topics();
		$topics->setTitre('Piscine à lyon');
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime);
		$topics->setStatus('Revu');
		$topics->setVotePositif(60);
		$topics->setVoteNegatif(8);
		$topics->setBudget(20000);
		$topics->setReponse('Demande accepté');
		$topics->setAuteur($this->getReference('user1'));

		$this->addReference('topic1', $topics);

		$manager->persist($topics);

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("construction d'un nouvel arret de bus rue Bourget");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('Ouvert');
		$topics->setVotePositif(67);
		$topics->setVoteNegatif(2);
		$topics->setBudget(34000);
		$topics->setReponse('Voici le devis');
		$topics->setAuteur($this->getReference('user2'));

		$this->addReference('topic2', $topics);

		$manager->persist($topics);		

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("création d'un parking covoiturage place Bellemont");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('A Valider');
		$topics->setVotePositif(20);
		$topics->setVoteNegatif(40);
		$topics->setBudget(107000);
		$topics->setReponse('Non favorable');
		$topics->setAuteur($this->getReference('user3'));

		$this->addReference('topic3', $topics);

		$manager->persist($topics);		

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("Allonger le temps de garderie, crèche des petits lutins ");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('Ouvert');
		$topics->setVotePositif(51);
		$topics->setVoteNegatif(50);
		$topics->setBudget(22000);
		$topics->setReponse("c'est tendu");
		$topics->setAuteur($this->getReference('user4'));

		$this->addReference('topic4', $topics);

		$manager->persist($topics);		

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("Interdiction des trotinettes electriques aux parc de la tete d'or");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('Réalisé');
		$topics->setVotePositif(90);
		$topics->setVoteNegatif(10);
		$topics->setBudget(0);
		$topics->setReponse("A mort les trotinettes");
		$topics->setAuteur($this->getReference('user5'));

		$this->addReference('topic5', $topics);

		$manager->persist($topics);		

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("Festival des lumières");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('A Valider');
		$topics->setVotePositif(89);
		$topics->setVoteNegatif(8);
		$topics->setBudget(100000);
		$topics->setReponse("Lyon c'est beau");
		$topics->setAuteur($this->getReference('user6'));

		$this->addReference('topic6', $topics);

		$manager->persist($topics);		

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("Ligne de métro Lyon - st Etienne");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('Refusé');
		$topics->setVotePositif(1);
		$topics->setVoteNegatif(99);
		$topics->setBudget(1000000);
		$topics->setReponse("NON");
		$topics->setAuteur($this->getReference('user7'));

		$this->addReference('topic7', $topics);

		$manager->persist($topics);		

		$manager->flush();

		$topics = New Topics();
		$topics->setTitre("Projection de la coupe du monde de foot féminine");
		$topics->SetContent($faker->text);
		$topics->setPicture('http://lorempixel.com/400/200/');
		$topics->setDateDeCreation($faker->dateTime($max = 'now', $timezone = null));
		$topics->setStatus('a Valider');
		$topics->setVotePositif(18);
		$topics->setVoteNegatif(70);
		$topics->setBudget(10000);
		$topics->setReponse("nn merci");
		$topics->setAuteur($this->getReference('user8'));

		$this->addReference('topic8', $topics);

		$manager->persist($topics);		

		$manager->flush();

	}

	public function getDependencies()
 	{
     return [UserFixtures::class];
	}


}
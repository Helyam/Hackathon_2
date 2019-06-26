<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class UserFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{

		$faker  =  Faker\Factory::create('fr_FR');

		$user = new User();
		$user->setPoints(0);
		$user->setEmail('representant@lyon.com');
		$user->setPassword('admin');
		$user->setFirstname('John');
		$user->setLastname('Duff');
		$user->setZone('Lyon');
		$user->setStatus('representant');
		$manager->persist($user);

		for ($i=0; $i < 100 ; $i++) { 
			$user = new User();
			$user->setPoints(0);
			$user->setEmail($faker->email);
			$user->setPassword('mdp');
			$user->setFirstname($faker->name);
			$user->setLastname($faker->name);
			$user->setZone('Lyon');
			$user->setStatus('citoyen');
			$manager->persist($user);
		}
		$manager->flush();
	}
}
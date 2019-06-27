<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
	private $encoder;

	public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}

	public function load(ObjectManager $manager)
	{

		$faker  =  Faker\Factory::create('fr_FR');

		$user = new User();
		$user->setPoints(0);
		$user->setEmail('representant@lyon.com');
		$user->setPassword($this->encoder->encodePassword($user,'admin'));
		$user->setFirstname('John');
		$user->setLastname('Duff');
		$user->setZone('Lyon');
		$user->setStatus('representant');
		$manager->persist($user);

		$user = new User();
		$user->setPoints(0);
		$user->setEmail('mdp@mdp.mdp');
		$user->setPassword($this->encoder->encodePassword($user,'mdp'));
		$user->setFirstname('John');
		$user->setLastname('Duff');
		$user->setZone('Lyon');
		$user->setStatus('citoyen');
		$manager->persist($user);

		for ($i=0; $i < 100 ; $i++) { 
			$user = new User();
			$user->setPoints(rand(0, 1000));
			$user->setEmail($faker->email);
			$user->setPassword($this->encoder->encodePassword($user,'mdp'));
			$user->setFirstname($faker->name);
			$user->setLastname($faker->name);
			$user->setZone('Lyon');
			$user->setStatus('citoyen');

			$this->addReference('vote' . $i, $user);

			$this->addReference('user' . $i, $user);

			$manager->persist($user);
		}
		$manager->flush();
	}
}
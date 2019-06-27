<?php
namespace App\Services;

use App\Repository\UserRepository;

Class DataManager 
{
		private $userRepo;

		public function __construct(UserRepository $userRepo)
		{
				$this->userRepo = $userRepo;
		}

	public function getRank() : array
	{
		$globalPoints = $this->userRepo->countGlobalPoints();
		$userPoints = 10;
		$pointPercentage = $globalPoints;

		return $pointPercentage;
	}
} 
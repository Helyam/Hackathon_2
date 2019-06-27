<?php
namespace App\Services;

use App\Repository\UserRepository;

Class DataManager 
{
		
		const RANK = [
			1 => 'Apprenti',
			2 => 'Compagnon',
			3 => 'Artisan',
			4 => 'Maitre  Artisan'
		];

		private $userRepo;

		public function __construct(UserRepository $userRepo)
		{
				$this->userRepo = $userRepo;
		}

		public function getRank(int $userpoints) : string
		{
			$data = $this->userRepo->countAvgMaxGlobalPoints();
			$max = $data[0][1];
			$avg = $data[0][2];
			if ($userpoints > $avg) {
				($userpoints > $avg +($max-$avg)/2) ? $rank = self::RANK[4] :$rank = self::RANK[3];
				}
				else{
				($userpoints > $avg/2)  ? $rank = self::RANK[2] :$rank = self::RANK[1];	
				}
			return $rank;
			}
}

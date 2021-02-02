<?php


namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Component\Routing\Annotation\Route;

class TeamController
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function __invoke(Team $data): Team
    {
        // TODO: Implement __invoke() method.
        return $data;
    }

}
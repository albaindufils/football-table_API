<?php
namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * @author Albain Dufils <albaindufils@gmail.com>
 * Class TeamRankingController
 *
 */
class TeamRankingController extends AbstractController {

    private GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @throws \Exception
     * @Route("/api/team_ranking")
     */
    public function __invoke(): Response
    {
        $teamRanking = $this->gameRepository->getTeamRanking();

        return $this->json($teamRanking);
    }

}
<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetGamesByPlayer extends AbstractController
{
    private GameRepository $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(
     *     name="get_games_by_player",
     *     path="/api/players/{id}/games",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Game::class,
     *         "_api_item_operation_name"="get_games"
     *     }
     * )
     * @param $data
     * @return Response
     * @throws \Exception
     */
    public function getGamesByPlayer(int $id)
    {
        // echo $this->repository->getGamesByPlayer($data['id']);
        return $this->json($this->repository->getGamesByPlayer($id));
    }


    /**
     * @Route(
     *     name="get_games_by_team",
     *     path="/api/teams/{id}/games",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Game::class,
     *         "_api_item_operation_name"="get_games"
     *     }
     * )
     * @param $data
     * @return Response
     * @throws \Exception
     */
    public function getGamesByTeam(int $id)
    {
        // echo $this->repository->getGamesByPlayer($data['id']);
        return $this->json($this->repository->getGamesByTeam($id));
    }
}
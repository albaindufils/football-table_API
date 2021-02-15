<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }


    public function getGamesByPlayer($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            select id, (select name from team where id = playerGames.team_home_id) as team_home, (select name from team where id = playerGames.team_away_id) as team_away, score_home, score_away, datetime
            from (
                     select g1.*
                     from game g1 inner join team t on t.id = g1.team_away_id
                     where t.player1_id = :id or t.player2_id = :id
                     union
                     select g2.*
                     from game g2 inner join team t on t.id = g2.team_home_id
                     where t.player1_id = :id or t.player2_id = :id
                 ) playerGames
            group by playerGames.id;
        ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetchAllAssociative();
        } catch (Exception $e) {
            throw new \Exception('Error while getting games from players');
        }


    }

    public function getGamesByTeam($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            select game.id as id, game.datetime as datetime, game.score_away, game.score_home, t.name as team_home, t2.name as team_away
            from game
            inner join team t on t.id = game.team_home_id
            inner join team t2 on t2.id = game.team_away_id
            where game.team_away_id = :id or game.team_home_id = :id
        ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetchAllAssociative();
        } catch (Exception $e) {
            throw new \Exception('Error while getting games from players');
        }


    }

    public function getTeamRanking()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select ROW_NUMBER() OVER(ORDER BY wins desc) AS rank, team_id, team_name, gamePlayed, wins, losses, round(cast(wins as float) / cast(gamePlayed as float), 2) as winRatio, goalsFor, goalsAgainst, goalsFor-goalsAgainst as goalsDiff
            from (select
                team_id,
                team.name as team_name,
                sum(rankingList.nbrGame) as gamePlayed,
                sum(rankingList.nbrWin) as wins,
                sum(rankingList.nbrLoss) as losses,
                sum(rankingList.goalPut) as goalsFor,
                sum(rankingList.goalTake) as goalsAgainst
            from (
                select
                    team_home_id as team_id,
                    count(score_home) as nbrGame,
                    COUNT(CASE WHEN score_home > score_away THEN 1 END) as nbrWin,
                    COUNT(CASE WHEN score_home < score_away THEN 1 END) as nbrLoss,
                    sum(score_home) as goalPut,
                    sum(score_away) as goalTake
                from game
                group by game.team_home_id
                union
                select
                     team_away_id as team_id,
                     count(score_away) as nbrWin,
                     COUNT(CASE WHEN score_away > score_home THEN 1 END) as nbrWin,
                     COUNT(CASE WHEN score_away < score_home THEN 1 END) as nbrLoss,
                     sum(score_away) as goalPut,
                     sum(score_home) as goalTake
                from game
                group by game.team_away_id
            ) rankingList
            INNER JOIN team ON team_id = team.id
            group by rankingList.team_id)
            order by wins desc, winRatio desc;
            ';
        try {

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAllAssociative();
        } catch (Exception $e) {
            throw new \Exception('Error while processing statistics');
        }

    }

    /*
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

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



    // /**
    //  */
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

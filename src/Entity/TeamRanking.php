<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\TeamRankingController;

/**
 * @author Albain Dufils <albaindufils@gmail.com>
 * Class TeamRanking
 * @package App\Entity
 *
 */
class TeamRanking
{
     private int $rank;

    /**
     *
     * @ApiProperty(identifier=true)
     */
    private Team $team;

    private int $gamePlayed;
    private int $wins;
    private int $losses;
    private float $winRatio;
    private int $goalsFor;
    private int $goalsAgainst;
    private int $goalsDiff;

    public function __construct($rank, $team, $gamePlayed, $wins, $losses, $winRatio, $goalsFor, $goalsAgainst, $goalsDiff)
    {
        $this->rank = $rank;
        $this->team = $team;
        $this->gamePlayed = $gamePlayed;
        $this->wins = $wins;
        $this->losses = $losses;
        $this->winRatio = $winRatio;
        $this->goalsFor = $goalsFor;
        $this->goalsAgainst = $goalsAgainst;
        $this->goalsDiff = $goalsDiff;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team $team
     */
    public function setTeam(Team $team): void
    {
        $this->team = $team;
    }

    /**
     * @return int
     */
    public function getGamePlayed(): int
    {
        return $this->gamePlayed;
    }

    /**
     * @param int $gamePlayed
     */
    public function setGamePlayed(int $gamePlayed): void
    {
        $this->gamePlayed = $gamePlayed;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins(int $wins): void
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getLosses(): int
    {
        return $this->losses;
    }

    /**
     * @param int $losses
     */
    public function setLosses(int $losses): void
    {
        $this->losses = $losses;
    }

    /**
     * @return float
     */
    public function getWinRatio(): float
    {
        return $this->winRatio;
    }

    /**
     * @param float $winRatio
     */
    public function setWinRatio(float $winRatio): void
    {
        $this->winRatio = $winRatio;
    }

    /**
     * @return int
     */
    public function getGoalsFor(): int
    {
        return $this->goalsFor;
    }

    /**
     * @param int $goalsFor
     */
    public function setGoalsFor(int $goalsFor): void
    {
        $this->goalsFor = $goalsFor;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst(): int
    {
        return $this->goalsAgainst;
    }

    /**
     * @param int $goalsAgainst
     */
    public function setGoalsAgainst(int $goalsAgainst): void
    {
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * @return int
     */
    public function getGoalsDiff(): int
    {
        return $this->goalsDiff;
    }

    /**
     * @param int $goalsDiff
     */
    public function setGoalsDiff(int $goalsDiff): void
    {
        $this->goalsDiff = $goalsDiff;
    }


}
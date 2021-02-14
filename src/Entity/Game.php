<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"game:read", "team:read"}},
 *     denormalizationContext={"groups"={"game:write"}},
 * )
 * @ORM\Entity
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     * @Groups({"game:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"game:read", "game:write"})
     */
    private \DateTimeInterface $datetime;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"game"})
     * @Groups({"game:read", "game:write"})
     */
    private int $scoreHome;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"game:read", "game:write"})
     */
    private int $scoreAway;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"team:read","game:read", "game:write"})
     */
    private Team $teamHome;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"team:read","game:read", "game:write"})
     */
    private Team $teamAway;

    public function __construct() { }

    public function getId(): int
    {
        return $this->id;
    }

    public function getScoreHome(): int
    {
        return $this->scoreHome;
    }

    public function getScoreAway(): int
    {
        return $this->scoreAway;
    }

    public function getTeamHome(): Team
    {
        return $this->teamHome;
    }

    public function getTeamAway(): Team
    {
        return $this->teamAway;
    }

    public function getDatetime(): \DateTimeInterface
    {
        return $this->datetime;
    }

    public function setScoreHome(int $scoreHome): void
    {
        $this->scoreHome = $scoreHome;
    }

    public function setScoreAway(int $scoreAway): void
    {
        $this->scoreAway = $scoreAway;
    }

    public function setTeamHome(Team $teamHome): void
    {
        $this->teamHome = $teamHome;
    }

    public function setTeamAway(Team $teamAway): void
    {
        $this->teamAway = $teamAway;
    }

    public function setDatetime(\DateTimeInterface $datetime): void
    {
        $this->datetime = $datetime;
    }



}

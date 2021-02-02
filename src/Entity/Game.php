<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $game_id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read", "write"})
     */
    private $datetime;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $score_home;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $score_away;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false, referencedColumnName="team_id")
     * @Groups({"read", "write"})
     */
    private $team_home;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false, referencedColumnName="team_id")
     * @Groups({"read", "write"})
     */
    private $team_away;

    public function getGameId(): ?int
    {
        return $this->game_id;
    }

    public function setGameId(int $game_id): self
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->score_home;
    }

    public function setScoreHome(string $score_home): self
    {
        $this->score_home = $score_home;

        return $this;
    }

    public function getScoreAway(): ?int
    {
        return $this->score_away;
    }

    public function setScoreAway(int $score_away): self
    {
        $this->score_away = $score_away;

        return $this;
    }

    public function getTeamHome(): ?Team
    {
        return $this->team_home;
    }

    public function setTeamHome(?Team $team_home): self
    {
        $this->team_home = $team_home;

        return $this;
    }

    public function getTeamAway(): ?Team
    {
        return $this->team_away;
    }

    public function setTeamAway(?Team $team_away): self
    {
        $this->team_away = $team_away;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read", "team"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $team_id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="teams_1")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="player_id")
     * @Groups({"read", "write"})
     */
    private $player_1;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="teams_2")
     * @ORM\JoinColumn(referencedColumnName="player_id")
     * @Groups({"read", "write"})
     */
    private $player_2;

    public function getTeamId(): ?int
    {
        return $this->team_id;
    }

    public function setTeamId(int $team_id): self
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPlayer1(): ?Player
    {
        return $this->player_1;
    }

    public function setPlayer1(?Player $player_1): self
    {
        $this->player_1 = $player_1;

        return $this;
    }

    public function getPlayer2(): ?Player
    {
        return $this->player_2;
    }

    public function setPlayer2(?Player $player_2): self
    {
        $this->player_2 = $player_2;

        return $this;
    }
}

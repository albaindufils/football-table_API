<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $player_id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="player_1")
     * @Groups({"read"})
     */
    private $teams_1;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="player_2")
     * @Groups({"read"})
     */
    private $teams_2;

    public function __construct()
    {
        $this->teams_1 = new ArrayCollection();
        $this->teams_2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }

    public function setPlayerId(int $player_id): self
    {
        $this->player_id = $player_id;

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

    /**
     * @return Collection|Team[]
     */
    public function getTeams1(): Collection
    {
        return $this->teams_1;
    }

    public function addTeams1(Team $teams1): self
    {
        if (!$this->teams_1->contains($teams1)) {
            $this->teams_1[] = $teams1;
            $teams1->setPlayer1($this);
        }

        return $this;
    }

    public function removeTeams1(Team $teams1): self
    {
        if ($this->teams_1->removeElement($teams1)) {
            // set the owning side to null (unless already changed)
            if ($teams1->getPlayer1() === $this) {
                $teams1->setPlayer1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams2(): Collection
    {
        return $this->teams_2;
    }

    public function addTeams2(Team $teams2): self
    {
        if (!$this->teams_2->contains($teams2)) {
            $this->teams_2[] = $teams2;
            $teams2->setPlayer2($this);
        }

        return $this;
    }

    public function removeTeams2(Team $teams2): self
    {
        if ($this->teams_2->removeElement($teams2)) {
            // set the owning side to null (unless already changed)
            if ($teams2->getPlayer2() === $this) {
                $teams2->setPlayer2(null);
            }
        }

        return $this;
    }
}

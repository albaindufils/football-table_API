<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private string $name;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Player $player1;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Player $player2;

    public function __construct() { }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlayer1(): Player
    {
        return $this->player1;
    }

    public function getPlayer2(): ?Player
    {
        return $this->player2;
    }

    public function setPlayer1(Player $player1): self
    {
        $this->player1 = $player1;
        return $this;
    }

    public function setPlayer2(?Player $player2): self
    {
        $this->player2 = $player2;
        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}

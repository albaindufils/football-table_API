<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"player:read", "team:read"}},
 *     denormalizationContext={"groups"={"team:write"}},
 *  )
 * @ORM\Entity
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     * @Groups({"team:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @Groups({"team:write", "team:read"})
     */
    private string $name;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"player:read", "team:write", "team:read"})
     */
    private Player $player1;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"player:read", "team:write", "team:read"})
     */
    private ?Player $player2;

    public function __construct() { }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Player
     */
    public function getPlayer1(): Player
    {
        return $this->player1;
    }

    /**
     * @param Player $player1
     */
    public function setPlayer1(Player $player1): void
    {
        $this->player1 = $player1;
    }

    /**
     * @return Player|null
     */
    public function getPlayer2(): ?Player
    {
        return $this->player2;
    }

    /**
     * @param Player|null $player2
     */
    public function setPlayer2(?Player $player2): void
    {
        $this->player2 = $player2;
    }


}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"player:read"}},
 *     denormalizationContext={"groups"={"player:write"}},
 *     itemOperations={
 *          "get",
 *          "put"
 *     }
 *
 * )
 * @ORM\Entity
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     * @Groups({"player:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"player:write", "player:read"})
     */
    private string $name;

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


}

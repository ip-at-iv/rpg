<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Player;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\Player\Collection as PlayerCollection;
use Demyanseleznev\Rpg\PlayerInterface;

final class Player implements PlayerInterface
{
    private string             $name;
    private CharacterInterface $character;
    private PlayerCollection   $targets;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setCharacter(CharacterInterface $character): void
    {
        $this->character = $character;
    }

    public function setTargetList(PlayerCollection $targets): void
    {
        $this->targets = $targets;
    }

    public function character(): CharacterInterface
    {
        return $this->character;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function targetList(): PlayerCollection
    {
        return $this->targets;
    }
}
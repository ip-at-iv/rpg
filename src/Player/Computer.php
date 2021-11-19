<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Player;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\Player\Collection as PlayerCollection;
use Demyanseleznev\Rpg\PlayerInterface;

final class Computer implements PlayerInterface
{
    private CharacterInterface $character;
    private PlayerCollection   $targets;

    public function __construct(CharacterInterface $character)
    {
        $this->character = $character;
    }

    public function character(): CharacterInterface
    {
        return $this->character;
    }

    public function name(): string
    {
        return 'CPU';
    }

    public function targetList(): PlayerCollection
    {
        return $this->targets;
    }

    public function setTargetList(PlayerCollection $targets): void
    {
        $this->targets = $targets;
    }
}
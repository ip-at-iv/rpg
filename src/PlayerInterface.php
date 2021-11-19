<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use Demyanseleznev\Rpg\Player\Collection as PlayerCollection;

interface PlayerInterface
{
    public function character(): CharacterInterface;

    public function setTargetList(PlayerCollection $targets): void;

    public function targetList(): PlayerCollection;

    public function name(): string;
}
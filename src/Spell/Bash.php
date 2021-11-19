<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\SpellInterface;
use Demyanseleznev\Rpg\TargetInterface;

final class Bash implements SpellInterface
{
    public function affect(CharacterInterface $caster, CharacterInterface $target): void
    {
        $damage = $caster->power() * 2; // formula
        $target->takeDamage($damage);
    }

    public function manacost(): int
    {
        return 50; // todo: formula
    }

    public function name(): string
    {
        return 'Bash';
    }
}
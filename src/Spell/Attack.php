<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\SpellInterface;
use Exception;

/**
 * Represents basic attack.
 * All characters should be able to use this spell.
 *
 * Does not require mana.
 * Does not modify character state.
 */
final class Attack implements SpellInterface
{
    public function affect(CharacterInterface $caster, CharacterInterface $target): void
    {
        if ($caster === $target) {
            throw InvalidTargetException::forTarget($target);
        }

        $target->takeDamage($caster->power());
    }

    public function manacost(): int
    {
        return 0;
    }

    public function name(): string
    {
        return 'Attack';
    }

}
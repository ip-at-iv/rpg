<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\SpellInterface;

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
        if (!$this->canCast($caster, $target)) {
            return;
        }

        $target->takeDamage($caster->power());
    }

    public function manacost(): int
    {
        return 0;
    }

    public function name(): string
    {
        return 'attack';
    }

    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool
    {
        return $caster !== $target;
    }

    public function describe(): string
    {
        return 'Basic attack. Deals damage equal to your power (%s). Usage does not consume mana.';
    }
}
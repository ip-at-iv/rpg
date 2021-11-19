<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\Effect\Protection;
use Demyanseleznev\Rpg\SpellInterface;

/**
 * Represents basic defense mechanism.
 * All characters should be able to use this skill.
 *
 * Does not cost mana.
 * Modifies character state by multiplying defense.
 */
final class Defense implements SpellInterface
{
    public function affect(CharacterInterface $caster, CharacterInterface $target): void
    {
        if (!$this->canCast($caster, $target)) {
            return;
        }

        $target->effect(new Protection(2));
    }

    public function manacost(): int
    {
        return 0;
    }

    public function name(): string
    {
        return 'defend';
    }

    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool
    {
        return $caster === $target;
    }
}
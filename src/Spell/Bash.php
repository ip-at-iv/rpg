<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\SpellInterface;

final class Bash implements SpellInterface {
    public function affect(CharacterInterface $caster, CharacterInterface $target): void {
        if (!$this->canCast($caster, $target)) {
            return;
        }

        $damage = $caster->power() * 1.5; // formula
        $target->takeDamage($damage);
        $caster->currentMana -= $this->manacost();
    }

    public function manacost(): int {
        return 25; // todo: formula
    }

    public function name(): string {
        return 'bash';
    }

    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool {
        return $caster->currentMana >= $this->manacost() && $caster !== $target;
    }
}
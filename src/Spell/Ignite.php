<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\Effect\Ignition;
use Demyanseleznev\Rpg\SpellInterface;

final class Ignite implements SpellInterface {
    public function affect(CharacterInterface $caster, CharacterInterface $target): void {
        if (!$this->canCast($caster, $target)) {
            return; // exception maybe?
        }

        $damage = $caster->power() * 1.5; // formula
        $target->effect(new Ignition(2, $damage));
        $target->currentMana -= $this->manacost();
    }

    public function name(): string {
        return 'ignite';
    }

    public function manacost(): int {
        return 30;
    }

    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool {
        return $caster !== $target;
    }
}
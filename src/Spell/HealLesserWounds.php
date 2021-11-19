<?php

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\Character\Mage;
use Demyanseleznev\Rpg\CharacterInterface;

class HealLesserWounds implements \Demyanseleznev\Rpg\SpellInterface {

    public function affect(CharacterInterface $caster, CharacterInterface $target): void {
        if(!is_a($caster, Mage::class) & $caster->isAlive()){
            return;
        }
        $power = $caster->powerModifier * .5;

        $caster->currentHealth = $power;
    }
    public function name(): string {
        return 'HealLesserWounds';
    }
    public function manacost(): int {
        return 30;
    }
    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool {
        return $caster !== $target;
    }
}
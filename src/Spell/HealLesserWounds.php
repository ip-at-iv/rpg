<?php

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\Character\Warrior;
use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\SpellInterface;

class HealLesserWounds implements SpellInterface {

    public function affect(CharacterInterface $caster, CharacterInterface $target): void {
        if (!is_a($caster, Warrior::class) & $caster->isAlive()) {
            return;
        }
        $power = $caster->power() * .5;
        $caster->currentHealth += +$power;
    }
    public function name(): string {
        return 'HealLesserWounds';
    }
    public function manacost(): int {
        return 30;
    }
    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool {
        return $caster === $target;
    }
    public function describe(): string {
        // TODO: Implement describe() method.
    }
}
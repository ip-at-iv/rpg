<?php

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\SpellInterface;

class Heal implements SpellInterface {

    private float $power;
    public function __construct(float $intelligence) {
        $this->power = ($intelligence * $intelligence)*3;
    }

    public function affect(CharacterInterface $caster, CharacterInterface $target): void {
        if($caster->currentHealth>=$caster->health()){
            return;
        }
        $errorRate = $caster->health() / $this->power;
        $healWithError = ($errorRate) > 2 ? 1 : ($errorRate - 1) * $this->power;
        $caster->currentHealth = $caster->currentHealth + $healWithError;
    }
    public function name(): string {
        return 'Heal';
    }
    public function manacost(): int {
        return $this->power / 1.3;
    }
    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool {
        return $caster === $target;
    }
}
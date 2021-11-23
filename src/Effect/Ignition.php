<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Effect;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\EffectInterface;

/**
 * Applies damage on every turn.
 * Does not proc on first turn.
 */
final class Ignition implements EffectInterface {
    private float $damage;
    private bool  $applied;
    private int   $turns;

    public function __construct(int $turns, float $damage) {
        $this->applied = false;
        $this->damage = $damage;
        $this->turns = $turns;
    }

    public function notify(CharacterInterface $target): void {
        if (!$this->applied) {
            $this->applied = true;
        } else {
            $target->takeDamage($this->damage);
            $this->turns -= 1;
        }

        // debuff wears off.
        if ($this->turns == 0) {
            $target->effects()->remove($this);
        }
    }
}
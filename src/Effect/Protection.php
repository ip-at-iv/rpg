<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Effect;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\EffectInterface;

/**
 * Represents "Defense" buff.
 * Increases character defense for a couple of turns.
 * Should be created by Defense spell.
 */
final class Protection implements EffectInterface
{
    private bool $applied;
    private int $turns;

    public function __construct(int $turns)
    {
        $this->turns = $turns;
        $this->applied = false;
    }

    public function notify(CharacterInterface $target): void
    {
        // buff wears off
        if ($this->turns == 0) {
            $target->defenseModifier -= 0.5;
            $target->effects()->remove($this);
        }
        
        if (!$this->applied) {
            $target->defenseModifier += 0.5;
            $this->applied = true;
        }

        $this->turns -= 1;
    }
}
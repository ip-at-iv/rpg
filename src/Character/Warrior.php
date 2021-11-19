<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Character;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\Effect\Collection as EffectCollection;
use Demyanseleznev\Rpg\EffectInterface;
use Demyanseleznev\Rpg\Spell\Attack;
use Demyanseleznev\Rpg\Spell\Bash;
use Demyanseleznev\Rpg\Spell\Collection as SpellCollection;
use Demyanseleznev\Rpg\Spell\Defense;

final class Warrior implements CharacterInterface
{
    private string           $name;
    public int             $health;
    public int             $defense;
    public int             $power;
    public int             $mana;

    private SpellCollection  $spells;
    private EffectCollection $effects;

    public function __construct(
            string $name,
            int $health,
            int $defense,
            int $mana,
            int $power
    ) {
        $this->name = $name;
        $this->health = $health;
        $this->defense = $defense;
        $this->mana = $mana;
        $this->power = $power;

        $this->spells = new SpellCollection([new Attack(), new Defense(), new Bash()]);
        $this->effects = new EffectCollection();
    }

    /**
     * MUST be called by TurnArbiter on every turn before interaction request.
     */
    public function update(): void
    {
        foreach ($this->effects as $effect) {
            $effect->notify($this);
        }
    }

    public function spells(): SpellCollection
    {
        return $this->spells;
    }

    public function health(): int
    {
        return $this->health;
    }

    public function defense(): int
    {
        return $this->defense;
    }

    public function power(): int
    {
        return $this->power;
    }

    public function mana(): int
    {
        return $this->mana;
    }

    public function effect(EffectInterface $effect): void
    {
        $this->effects[] = $effect;
    }

    public function takeDamage(int $damage): void
    {
        foreach ($this->effects as $effect) {
            $effect->notify($this);
        }

        $damage -= $this->defense;
        $this->health -= ($damage > 0) ? $damage : 0;

        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function name(): string
    {
        return $this->name;
    }
}
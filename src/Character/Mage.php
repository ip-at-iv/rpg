<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Character;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\Effect\Collection as EffectCollection;
use Demyanseleznev\Rpg\EffectInterface;
use Demyanseleznev\Rpg\Spell\Attack;
use Demyanseleznev\Rpg\Spell\Collection as SpellCollection;
use Demyanseleznev\Rpg\Spell\Defense;
use Demyanseleznev\Rpg\Spell\Ignite;

final class Mage implements CharacterInterface {
    public float $currentHealth;
    public float $currentMana;
    public float $defenseModifier     = 1.0;
    public float $powerModifier       = 1.0;
    public float $healthRegenModifier = 1.0;
    public float $manaRegenModifier   = 1.0;
    private string $name;
    private int    $strength;
    private int    $dexterity;
    private int    $intelligence;
    private SpellCollection  $spells;
    private EffectCollection $effects;

    public function __construct(
            string $name,
            int    $strength,
            int    $dexterity,
            int    $intelligence
    ) {
        $this->name = $name;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->intelligence = $intelligence;

        $this->spells = new SpellCollection([new Attack(), new Defense(), new Ignite()]);
        $this->effects = new EffectCollection();
    }

    public function update(): void {
        foreach ($this->effects as $effect) {
            $effect->notify($this);
        }
    }

    public function health(): float {
        return CharacterInterface::BASE_HEALTH + ($this->strength * CharacterInterface::STRENGTH_MODIFIER);
    }

    public function defense(): float {
        return CharacterInterface::BASE_DEFENSE + ($this->dexterity * CharacterInterface::DEXTERITY_MODIFIER);
    }

    public function mana(): float {
        return CharacterInterface::BASE_MANA + ($this->intelligence * CharacterInterface::INTELLIGENCE_MODIFIER);
    }

    public function power(): float {
        return CharacterInterface::BASE_POWER + $this->intelligence;
    }

    public function effect(EffectInterface $effect): void {
        $this->effects->push($effect);
    }

    public function takeDamage(float $damage): void {
        // TODO: Implement takeDamage() method.
    }

    public function spells(): SpellCollection {
        return $this->spells;
    }

    public function name(): string {
        return $this->name;
    }

    public function isAlive(): bool {
        return $this->currentHealth > 0;
    }

    public function effects(): EffectCollection {
        return $this->effects;
    }

    public function healthRegen(): float {
        // TODO: Implement healthRegen() method.
    }

    public function manaRegen(): float {
        // TODO: Implement manaRegen() method.
    }


}
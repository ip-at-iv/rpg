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
use Demyanseleznev\Rpg\Spell\Heal;
use Demyanseleznev\Rpg\Spell\HealLesserWounds;

final class Warrior implements CharacterInterface
{
    private string $name;
    private int    $strength;
    private int    $dexterity;
    private int    $intelligence;

    public float $currentHealth;
    public float $currentMana;
    public float $defenseModifier = 1.0;
    public float $powerModifier = 1.0;
    public float $healthRegenModifier = 1.0;
    public float $manaRegenModifier = 1.0;

    private SpellCollection  $spells;
    private EffectCollection $effects;

    public function __construct(
            string $name,
            int $strength,
            int $dexterity,
            int $intelligence
    ) {
        $this->name = $name;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->intelligence = $intelligence;

        $this->currentHealth = $this->health();
        $this->currentMana = $this->mana();

        $this->spells = new SpellCollection([new Attack(), new Defense(), new Bash(), new HealLesserWounds()]);
        $this->effects = new EffectCollection();
    }

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

    public function health(): float
    {
        return CharacterInterface::BASE_HEALTH + ($this->strength * CharacterInterface::STRENGTH_MODIFIER);
    }

    public function mana(): float
    {
        return CharacterInterface::BASE_MANA + ($this->intelligence * CharacterInterface::INTELLIGENCE_MODIFIER);
    }

    public function healthRegen(): float
    {
        $base = CharacterInterface::BASE_HEALTH_REGEN;
        $base += ($this->strength + CharacterInterface::BASE_HEALTH_REGEN);
        $base *= $this->healthRegenModifier;

        return $base;
    }

    public function manaRegen(): float
    {
        $base = CharacterInterface::BASE_MANA_REGEN;
        $base += ($this->intelligence * CharacterInterface::BASE_MANA_REGEN);
        $base *= $this->manaRegenModifier;

        return $base;
    }

    public function defense(): float
    {
        return (CharacterInterface::BASE_DEFENSE + ($this->dexterity * CharacterInterface::DEXTERITY_MODIFIER)) * $this->defenseModifier;
    }

    public function power(): float
    {
        return (CharacterInterface::BASE_POWER + $this->strength) * $this->powerModifier;
    }

    public function effect(EffectInterface $effect): void
    {
        $this->effects->push($effect);
    }

    public function takeDamage(float $damage): void
    {
        $damage -= $this->defense();
        $this->currentHealth -= ($damage > 0) ? $damage : 0;

        if ($this->currentHealth < 0) {
            $this->currentHealth = 0;
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function effects(): EffectCollection
    {
        return $this->effects;
    }

    public function isAlive(): bool
    {
        return $this->currentHealth > 0;
    }
}
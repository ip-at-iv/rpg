<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use Demyanseleznev\Rpg\Effect\Collection as EffectCollection;
use Demyanseleznev\Rpg\Spell\Collection as SpellCollection;

interface CharacterInterface extends TargetInterface
{
    public const BASE_HEALTH = 100;
    public const BASE_DEFENSE = 10;
    public const BASE_MANA = 50;
    public const BASE_POWER = 30;
    public const BASE_HEALTH_REGEN = 2;
    public const BASE_MANA_REGEN = 1.5;

    public const STRENGTH_MODIFIER = 2.5;
    public const DEXTERITY_MODIFIER = 1.5;
    public const INTELLIGENCE_MODIFIER = 2;

    /**
     * MUST be called by TurnArbiter on every turn before interaction request.
     */
    public function update(): void;

    public function mana(): float;

    public function health(): DepletableParameterInterface;

    public function defense(): DepletableParameterInterface;

    public function power(): float;

    public function healthRegen(): float;

    public function manaRegen(): float;

    public function effect(EffectInterface $effect): void;

    public function takeDamage(float $damage): void;

    public function spells(): SpellCollection;

    public function effects(): EffectCollection;

    public function name(): string;

    public function isAlive(): bool;
}
<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use Demyanseleznev\Rpg\Spell\Collection as SpellCollection;

interface CharacterInterface extends TargetInterface
{
    public const BASE_HEALTH = 100;
    public const BASE_DEFENSE = 10;
    public const BASE_MANA = 50;

    public function update(): void;

    public function mana(): int;

    public function health(): int;

    public function defense(): int;

    public function power(): int;

    public function effect(EffectInterface $effect): void;

    public function takeDamage(int $damage): void;

    public function spells(): SpellCollection;

    public function name(): string;
}